<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/return', name: 'app_return')]
    public function return(): Response
    {
        return $this->render('account/return.html.twig', [
        ]);
    }
    #[Route('/success', name: 'app_success')]
    public function success(): Response
    {
        return $this->render('account/success.html.twig', [
        ]);
    }
}
