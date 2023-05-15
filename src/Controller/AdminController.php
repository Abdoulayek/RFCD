<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\StagiairesRepository;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function dashboard(StagiairesRepository $StagiairesRepository): Response
    {
        $elements = $StagiairesRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'elements' => $elements,
        ]);
    }
}
