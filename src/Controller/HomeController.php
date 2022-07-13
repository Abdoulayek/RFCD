<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        return $this->render('registration/register.html.twig', 
        ['form' => $form->createView()]);
    }

    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function stagiaire(): Response
    {
        return $this->render('stagiaire/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/modifstagiaire', name: 'app_modifstagiaire')]
    public function modifstagiaire(): Response
    {
        return $this->render('stagiaire/modif.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
