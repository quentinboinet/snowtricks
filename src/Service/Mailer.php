<?php


namespace App\Service;


use App\Entity\PasswordToken;
use App\Entity\RegistrationToken;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class Mailer
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(User $user, string $subject, string $template, RegistrationToken $registrationToken = null, PasswordToken $passwordToken = null)
    {
        if ($registrationToken == null) { $token = $passwordToken; } else { $token = $registrationToken; }
        $email = (new TemplatedEmail())
            ->from('quentinboinet@live.fr')
            ->to($user->getEmail())
            ->subject($subject)
            //->html('<h3>SnowTricks</h3><p>Votre compte est pour le moment inactif. Afin
            //  de l\'activer et de pouvoir vous connecter, merci de cliquer sur le lien suivant : <a href="localhost:8000/api/account/confirm/' . $userId . '/' . $token->getToken() . '">confirmer mon inscription !</a></p>
            //   <p>A très vite !<br /><b>L\'équipe SnowTricks</b></p>');

            ->htmlTemplate($template)
            ->context([
                'api_token' => $token->getToken(),
                'user_id' => $user->getId(),
            ]);

        $this->mailer->send($email);
    }
}