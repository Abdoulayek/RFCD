<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/certificateur', name: 'app_certificateur')]
    public function certificateur(): Response
    {
        return $this->render('home/certificateur.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
