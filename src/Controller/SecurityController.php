<?php

namespace App\Controller;

use App\Entity\RegistrationToken;
use App\Entity\User;
use App\Form\UserRegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

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
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

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

            //on envoi l'e-mail de confirmation d'inscription
            $email = (new Email())
            ->from('quentinboinet@live.fr')
                ->to($form['email']->getData())
                ->subject('SnowTricks - Confirmation d\'inscription')
                ->html('<h3>SnowTricks</h3><p>Merci pour votre inscription sur le site communautaire SnowTricks ! <br/>Cependant, votre compte est pour le moment inactif. Afin
                de l\'activer et de pouvoir vous connecter, merci de cliquer sur le lien suivant : <a href="localhost:8000/api/account/confirm/' . $user->getId() . '/' . $token->getToken() . '">confirmer mon inscription !</a></p>
                <p>A très vite !<br /><b>L\'équipe SnowTricks</b></p>');

            $this->mailer->send($email);

            $this->addFlash('success', 'Inscription prise en compte ! Un e-mail contenant un lien d\'activation vous a été envoyé.');
            return $this->redirectToRoute('home_page');
        }
        return $this->render('security/register.html.twig', ['registrationForm' => $form->createView()]);
    }
}
