<?php


namespace App\Controller;


use App\Entity\PasswordToken;
use App\Entity\Picture;
use App\Entity\RegistrationToken;
use App\Entity\User;
use App\Service\Mailer;
use App\Service\TokenChecker;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class AccountController extends AbstractController
{

    /**
     * @Route ("/api/account/confirm/{userId}/{token}", name="api_account_confirm")
     */
    public function registrationConfirm($userId, $token, EntityManagerInterface $em, TokenChecker $tokenChecker)
    {
         //on regarde si un token avec cet id d'user existe bien dans la table RegistrationToken, et on vérifie aussi qu'il n'a pas expiré
        $tokenRepo = $em->getRepository(RegistrationToken::class);
        $token = $tokenRepo->findOneBy(['user' => $userId, 'token' => $token]);
        if (!empty($token)) {
            $result = $tokenChecker->registrationToken('accountConfirm', $token, null, $userId);
            if ($result == "OK") {
                $this->addFlash('success', 'Votre compte est désormais activé ! Vous pouvez vous connecter.');
                return $this->redirectToRoute('home_page');
            }
            elseif ($result == "expired") {
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
    public function resendRegistrationToken($userId, EntityManagerInterface $em, Mailer $mailerService)
    {
        $userRepo = $em->getRepository(User::class);
        $user = $userRepo->find($userId);

        //on crée le token qui servira à valider son compte
        $token = new RegistrationToken($user);
        $em->persist($token);
        $em->flush();

        //on envoi l'e-mail de confirmation d'inscription
        $mailerService->sendMail($user, 'SnowTricks - Validation d\'inscription', 'email/registrationConfirm.html.twig', $token);

        $this->addFlash('success', 'Merci ! Un e-mail contenant un lien d\'activation vous a été envoyé.');
        return $this->redirectToRoute('home_page');
    }

    /**
     * @Route("/forgotPassword", name="api_forgot_password")
     */
    public function forgotPassword(Request $request, EntityManagerInterface $em, Mailer $mailerService)
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
                $mailerService->sendMail($user, 'SnowTricks - Mot de passe oublié', 'email/forgetPassword.html.twig', null, $token);

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
    public function resetPassword($userId, $token, EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder, TokenChecker $tokenChecker)
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
                $result = $tokenChecker->registrationToken('resetPassword', null, $token, $userId);
                if ($result == "OK") {
                    $userRepo = $em->getRepository(User::class);
                    $user = $userRepo->find($userId);
                    return $this->render('security/resetPassword.html.twig', ['error' => '', 'username' => $user->getUsername()]);
                }
                elseif ($result == "expired") {
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
    public function editProfile(EntityManagerInterface $em, Request $request, Security $security, UserPasswordEncoderInterface $passwordEncoder)
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

            if($request->request->get('newPassword1') != "") { //si l'utilisateur souhaite modifier son mot de passe

                $oldPassword = $request->request->get('oldPassword');
                $newPassword1 = $request->request->get('newPassword1');
                $newPassword2 = $request->request->get('newPassword2');

                if ($oldPassword != "") {
                    if ($newPassword1 == $newPassword2) {
                        if ($passwordEncoder->isPasswordValid($user, $oldPassword)) { //si le mot de passe entré correspond bien à celui enregistré en bdd

                            $user->setPassword($passwordEncoder->encodePassword($user, $newPassword1));

                        }
                        else {
                            return $this->render('profile/profileEdit.html.twig', ['error' => 'Le mot de passe actuel entré est incorrect !']);
                        }
                    }
                    else {
                        return $this->render('profile/profileEdit.html.twig', ['error' => 'Le mot de passe entré dans la confirmation n\'est pas identique au premier.']);
                    }
                }
                else {
                    return $this->render('profile/profileEdit.html.twig', ['error' => 'Veuillez renseigner votre ancien mot de passe pour pouvoir le modifier.']);
                }
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