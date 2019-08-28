<?php

namespace App\Controller;

use App\Entity\RegistrationToken;
use App\Form\UserRegistrationFormType;
use App\Service\Mailer;
use Doctrine\DBAL\DBALException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/app_logout_message", name="app_logout_message")
     */
    public function logout_message()
    {
        $this->addFlash('success', 'Vous êtes maintenant déconnecté !');
        return $this->redirectToRoute('home_page');
    }

    /**
     * @Route ("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, Mailer $mailerService)
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            try {
                //on insère l'user en BDD
                $user = $form->getData();
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $form['plainPassword']->getData()
                ));
                $user->setStatus(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                //on crée le token qui servira à valider son compte
                $token = new RegistrationToken($user);
                $em->persist($token);
                $em->flush();
            } catch (DBALException $e) {
                $this->addFlash('fail', 'Un problème est survenu lors de votre inscription. Veuillez réessayer.');
                return $this->redirectToRoute('app_register');
            }

            //on envoi l'e-mail de confirmation d'inscription
            $mailerService->sendMail($user, 'SnowTricks - Confirmation d\'inscription', 'email/registrationConfirm.html.twig', $token, null);

            $this->addFlash('success', 'Inscription prise en compte ! Un e-mail contenant un lien d\'activation vous a été envoyé.');
            return $this->redirectToRoute('home_page');
        }
        return $this->render('security/register.html.twig', ['registrationForm' => $form->createView()]);
    }
}
