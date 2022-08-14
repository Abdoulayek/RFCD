<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/loginc', name: 'app_loginc')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    #[Route('/certificateur', name: 'app_certificateur')]
    public function certificateur(): Response
    {
        return $this->render('home/certificateur.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
