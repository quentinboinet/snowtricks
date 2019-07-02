<?php


namespace App\Controller;


use App\Entity\RegistrationToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

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
                $this->addFlash('fail', 'Le lien que vous avez utiilisé semble avoir expiré ! Veuillez contacter l\'administrateur.');
                return $this->redirectToRoute('home_page');
            }
        }
        else {
            $this->addFlash('fail', 'Lien invalide ! Veuillez contacter l\'administrateur.');
            return $this->redirectToRoute('home_page');
        }

        // puis enfin on supprime le token

    }
}