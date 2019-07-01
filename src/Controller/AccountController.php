<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    /**
     * @Route ("/api/account/confirm", name="api_account_confirm")
     */
    public function registrationConfirm()
    {

    }
}