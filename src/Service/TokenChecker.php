<?php


namespace App\Service;


use App\Entity\PasswordToken;
use App\Entity\RegistrationToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TokenChecker
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function registrationToken(string $type, RegistrationToken $token = null, PasswordToken $pwdToken = null, int $userId)
    {
        //on vérifie si le token n'a pas expiré
        $now = new \DateTime();
        if ($type == 'resetPassword') { $token = $pwdToken; }

        if ($token->getExpiresAt() > $now) {
            $userRepo = $this->em->getRepository(User::class);
            $user = $userRepo->find($userId);

            if ($type == 'accountConfirm') { $user->setStatus(1); $this->em->flush(); }

            //on supprime le token associé
            $this->em->remove($token);
            $this->em->flush();

            return "OK";
        }
        else {
            //on supprime le token associé
            $this->em->remove($token);
            $this->em->flush();

            return "expired";
        }
    }
}