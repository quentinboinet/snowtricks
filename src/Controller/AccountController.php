<?php


namespace App\Controller;


use App\Entity\PasswordToken;
use App\Entity\Picture;
use App\Entity\RegistrationToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class AccountController extends AbstractController
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route ("/api/account/confirm/{userId}/{token}", name="api_account_confirm")
     */
    public function registrationConfirm($userId, $token, EntityManagerInterface $em)
    {
         //on regarde si un token avec cet id d'user existe bien dans la table RegistrationToken, et on vérifie aussi qu'il n'a pas expiré
        $tokenRepo = $em->getRepository(RegistrationToken::class);
        $token = $tokenRepo->findOneBy(['user' => $userId, 'token' => $token]);
        if (!empty($token)) {
            //on vérifie si le token n'a pas expiré
            $now = new \DateTime();
            if ($token->getExpiresAt() > $now) {
                $userRepo = $em->getRepository(User::class);
                $user = $userRepo->find($userId);
                $user->setStatus(1);//
                $em->flush();

                //on supprime le token associé
                $em->remove($token);
                $em->flush();

                //enfin redirige vers l'accueil après avoir updaté le statut de l'user à 1
                $this->addFlash('success', 'Votre compte est désormais activé ! Vous pouvez vous connecter.');
                return $this->redirectToRoute('home_page');
            }
            else {

                //on supprime le token associé
                $em->remove($token);
                $em->flush();

                $this->addFlash('fail', 'Le lien que vous avez utiilisé semble avoir expiré ! Veuillez contacter l\'administrateur.');
                return $this->redirectToRoute('home_page');
            }
        }
        else {
            $this->addFlash('fail', 'Lien invalide ! Veuillez contacter l\'administrateur.');
            return $this->redirectToRoute('home_page');
        }
    }

    /**
     * @Route("/api/resendRegistrationToken/{userId}", name="api_resendRegistrationToken")
     */
    public function resendRegistrationToken($userId, EntityManagerInterface $em)
    {
        $userRepo = $em->getRepository(User::class);
        $user = $userRepo->find($userId);

        //on crée le token qui servira à valider son compte
        $token = new RegistrationToken($user);
        $em->persist($token);
        $em->flush();

        //on envoi l'e-mail de confirmation d'inscription
        $email = (new Email())
            ->from('quentinboinet@live.fr')
            ->to($user->getEmail())
            ->subject('SnowTricks - Validation d\'inscription')
            ->html('<h3>SnowTricks</h3><p>Votre compte est pour le moment inactif. Afin
                de l\'activer et de pouvoir vous connecter, merci de cliquer sur le lien suivant : <a href="localhost:8000/api/account/confirm/' . $userId . '/' . $token->getToken() . '">confirmer mon inscription !</a></p>
                <p>A très vite !<br /><b>L\'équipe SnowTricks</b></p>');

        $this->mailer->send($email);

        $this->addFlash('success', 'Merci ! Un e-mail contenant un lien d\'activation vous a été envoyé.');
        return $this->redirectToRoute('home_page');
    }

    /**
     * @Route("/forgotPassword", name="api_forgot_password")
     */
    public function forgotPassword(Request $request, EntityManagerInterface $em)
    {
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $userRepo = $em->getRepository(User::class);
            $user = $userRepo->findOneBy(['username' => $username]);
            if (!empty($user)) { //si un utilisateur est bien enregistré avec cet username

                //on crée le token qui servira à changer son mot de passe
                $token = new PasswordToken($user);
                $em->persist($token);
                $em->flush();

                //on envoi le mail avec lien et token pour reset de mot de passe
                $email = (new Email())
                    ->from('quentinboinet@live.fr')
                    ->to($user->getEmail())
                    ->subject('SnowTricks - Mot de passe oublié')
                    ->html('<h3>SnowTricks</h3><p>Il semble que vous ayez oublié votre mot de passe sur notre site. Afin
                de pouvoir en choisir un nouveau et de pouvoir vous connecter, merci de cliquer sur le lien suivant : <a href="localhost:8000/api/account/resetPassword/' . $user->getId() . '/' . $token->getToken() . '">redéfinir mon mot de passe !</a></p>
                <p>A très vite !<br /><b>L\'équipe SnowTricks</b></p>');

                $this->mailer->send($email);

                $this->addFlash('success', 'Merci ! Un e-mail contenant un lien permettant de remettre à zéro votre mot de passe vous a été envoyé.');
                return $this->redirectToRoute('home_page');
            }
            else {
                $error = 'Aucun utilisateur connu sous ce nom !';
                return $this->render('security/forgotPassword.html.twig', ['error' => $error]);
            }

        }
        return $this->render('security/forgotPassword.html.twig', ['error' => '']);
    }

    /**
     * @Route ("/api/account/resetPassword/{userId}/{token}", name="api_account_resetPassword")
     */
    public function resetPassword($userId, $token, EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {

            $userRepo = $em->getRepository(User::class);
            $user = $userRepo->find($userId);
            $userEmail = $user->getEmail();
            $userEmailForm = $request->request->get('email');

            if ($userEmail === $userEmailForm) { //si l'email entré correspond bien à celui en BDD

                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $request->request->get('password')
                ));
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre mot de passe est désormais changé ! Vous pouvez vous connecter.');
                return $this->redirectToRoute('home_page');

            }
            else {
                $error = 'L\'adresse e-mail entrée ne correspond pas à celle définie avec votre compte !';
                return $this->render('security/resetPassword.html.twig', ['error' => $error, 'username' => $user->getUsername()]);
            }
        }
        else {
            //on regarde si un token avec cet id d'user existe bien dans la table RegistrationToken, et on vérifie aussi qu'il n'a pas expiré
            $tokenRepo = $em->getRepository(PasswordToken::class);
            $token = $tokenRepo->findOneBy(['user' => $userId, 'token' => $token]);
            if (!empty($token)) {
                //on vérifie si le token n'a pas expiré
                $now = new \DateTime();
                if ($token->getExpiresAt() > $now) {
                    $userRepo = $em->getRepository(User::class);
                    $user = $userRepo->find($userId);

                    //on supprime le token associé
                    $em->remove($token);
                    $em->flush();

                    return $this->render('security/resetPassword.html.twig', ['error' => '', 'username' => $user->getUsername()]);
                }
                else {

                    //on supprime le token associé
                    $em->remove($token);
                    $em->flush();

                    $this->addFlash('fail', 'Le lien que vous avez utiilisé semble avoir expiré ! Veuillez contacter l\'administrateur.');
                    return $this->redirectToRoute('home_page');
                }
            }
            else {
                $this->addFlash('fail', 'Lien invalide ! Veuillez contacter l\'administrateur.');
                return $this->redirectToRoute('home_page');
            }
        }
    }

    /**
     * @Route("/profile/view", name="profile_view")
     * @IsGranted("ROLE_USER")
     */
    public function viewProfile()
    {
        return $this->render('profile/profileView.html.twig');
    }

    /**
     * @Route("/profile/edit", name="profile_edit")
     * @IsGranted("ROLE_USER")
     */
    public function editProfile(EntityManagerInterface $em, Request $request, Security $security)
    {
        if ($request->isMethod('POST')) {
             $user = $security->getUser();
             $user->setFirstName($request->request->get('firstName'));
             $user->setLastName($request->request->get('lastName'));

            if (!empty($request->files->get('profilePicture'))) {

                //on upload et ajoute la nouvelle image à l'user
                /** @var UploadedFile $uploadedFile */
                $uploadedFile = $request->files->get('profilePicture');
                if ($uploadedFile->isValid() AND $uploadedFile->getSize() <= 2097152) {
                    if ($uploadedFile->guessExtension() == "jpg" OR $uploadedFile->guessExtension() == "jpeg" OR $uploadedFile->guessExtension() == "png" OR $uploadedFile->guessExtension() == "gif") {

                        $destination = $this->getParameter('kernel.project_dir') . '/public/images/uploads';
                        $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();
                        $uploadedFile->move($destination, $newFilename);

                        if ($request->request->get('picturesToEdit') == "cover-") {

                            $picture = new Picture();
                            $picture->setPath('/images/uploads/' . $newFilename);
                            $em->persist($picture);
                            $user->setProfilePicture($picture);
                        }
                        else {
                            $pictureIds = explode("-", $request->request->get('picturesToEdit'));
                            $pictureId = $pictureIds[0];
                            $picture = $em->getRepository(Picture::class)->find($pictureId);
                            $picturePath = $picture->getPath();

                            //on supprime l'ancienne image du serveur
                            $fileSystem = new Filesystem();
                            $fileName = $this->getParameter('kernel.project_dir') . '/public' . $picturePath;
                            $fileSystem->remove($fileName);

                            $picture->setPath('/images/uploads/' . $newFilename);
                            $em->persist($picture);
                        }


                    } else {
                        return $this->render('profile/profileEdit.html.twig', ['error' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.']);
                    }
                } else {
                    return $this->render('profile/profileEdit.html.twig', ['error' => 'Image trop lourde ! (max. 2Mo autorisé)']);
                }

            }

            //puis on supprime l'image de profil si le champ picturesToDelete est rempli
            if ($request->request->get('picturesToDelete') != "") {

                $pictureIds = explode("-", $request->request->get('picturesToDelete'));
                $pictureIdToDelete = $pictureIds[0];

                $picture = $em->getRepository(Picture::class)->find($pictureIdToDelete);
                $em->remove($picture);

                //on la supprime du serveur
                $fileSystem = new Filesystem();
                $fileName = $this->getParameter('kernel.project_dir') . '/public' . $picture->getPath();
                $fileSystem->remove($fileName);

                $user->setProfilePicture(null);
            }

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a bien été modifié !');
            return $this->redirectToRoute('profile_view');
        }
        else {
            return $this->render('profile/profileEdit.html.twig', ['error' => '']);
        }
    }
}