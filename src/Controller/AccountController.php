<?php

namespace App\Controller;

use App\Entity\PasswordToken;
use App\Entity\Picture;
use App\Entity\RegistrationToken;
use App\Entity\User;
use App\Form\ProfileInfosFormType;
use App\Form\ProfilePasswordFormType;
use App\Form\ProfilePictureFormType;
use App\Service\FileUploader;
use App\Service\Mailer;
use App\Service\TokenChecker;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
            if ('OK' == $result) {
                $this->addFlash('success', 'Votre compte est désormais activé ! Vous pouvez vous connecter.');

                return $this->redirectToRoute('home_page');
            } elseif ('expired' == $result) {
                $this->addFlash('fail', 'Le lien que vous avez utiilisé semble avoir expiré ! Veuillez contacter l\'administrateur.');

                return $this->redirectToRoute('home_page');
            }
        } else {
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
            } else {
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
            } else {
                $error = 'L\'adresse e-mail entrée ne correspond pas à celle définie avec votre compte !';

                return $this->render('security/resetPassword.html.twig', ['error' => $error, 'username' => $user->getUsername()]);
            }
        } else {
            //on regarde si un token avec cet id d'user existe bien dans la table RegistrationToken, et on vérifie aussi qu'il n'a pas expiré
            $tokenRepo = $em->getRepository(PasswordToken::class);
            $token = $tokenRepo->findOneBy(['user' => $userId, 'token' => $token]);
            if (!empty($token)) {
                $result = $tokenChecker->registrationToken('resetPassword', null, $token, $userId);
                if ('OK' == $result) {
                    $userRepo = $em->getRepository(User::class);
                    $user = $userRepo->find($userId);

                    return $this->render('security/resetPassword.html.twig', ['error' => '', 'username' => $user->getUsername()]);
                } elseif ('expired' == $result) {
                    $this->addFlash('fail', 'Le lien que vous avez utiilisé semble avoir expiré ! Veuillez contacter l\'administrateur.');

                    return $this->redirectToRoute('home_page');
                }
            } else {
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
     * @Route("/profile/edit/infos", name="profile_edit_infos")
     * @IsGranted("ROLE_USER")
     */
    public function editProfile(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ProfileInfosFormType::class, $this->getUser());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $user->setLastName($form['lastName']->getData());
            $user->setFirstName($form['firstName']->getData());
            $em->flush();

            $this->addFlash('success', 'Profil correctement mis à jour !');

            return $this->redirectToRoute('profile_view');
        } else {
            return $this->render('profile/profileEditInfos.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/profile/edit/password", name="profile_edit_password")
     * @IsGranted("ROLE_USER")
     */
    public function editPassword(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(ProfilePasswordFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if ($passwordEncoder->isPasswordValid($user, $form['old_password']->getData())) { //si le mot de passe entré correspond bien à celui enregistré en bdd
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $form['password']->getData()
                ));
                $em->flush();
            } else {
                $form->get('old_password')->addError(new FormError('Le mot de passe actuel est incorrect !'));

                return $this->render('profile/profileEditPassword.html.twig', ['form' => $form->createView()]);
            }

            $this->addFlash('success', 'Mot de passe correctement modifié !');

            return $this->redirectToRoute('profile_view');
        } else {
            return $this->render('profile/profileEditPassword.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/profile/edit/picture", name="profile_edit_picture")
     * @IsGranted("ROLE_USER")
     */
    public function editPicture(EntityManagerInterface $em, Request $request, FileUploader $fileUploader)
    {
        $form = $this->createForm(ProfilePictureFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileName = $fileUploader->upload($form['picture']->getData());
            if (null === $this->getUser()->getProfilePicture()) {
                $picture = new Picture();
                $picture->setPath('/images/uploads/'.$fileName);
                $this->getUser()->setProfilePicture($picture);
            } else {
                $pictureId = $this->getUser()->getProfilePicture()->getId();
                $picture = $em->getRepository(Picture::class)->find($pictureId);
                $picturePath = $picture->getPath();
                $fileSystem = new Filesystem();
                $oldfileName = $this->getParameter('kernel.project_dir').'/public'.$picturePath;
                $fileSystem->remove($oldfileName);
                $picture->setPath('/images/uploads/'.$fileName);
            }
            $em->persist($picture);
            $em->flush();

            $picture->setPath('/images/uploads/'.$fileName);
            $this->addFlash('success', 'Image de profil correctement mise à jour !');
            return $this->redirectToRoute('profile_view');
        } else {
            return $this->render('profile/profileEditPicture.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }
}
