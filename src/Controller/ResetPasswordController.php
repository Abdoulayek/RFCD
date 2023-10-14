<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/forgot-password", name="forgot_password")
     */
    public function forgotPassword(
        Request $request,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            $user = $userRepository->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'Adresse e-mail non trouvée.');
                return $this->redirectToRoute('forgot_password');
            }

            else {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                            $user,
                            $password 
                    )
                    );
                    $entityManager->persist($user);
                    $entityManager->flush();
        
                    $this->addFlash('success', 'Un nouveau mot de passe a été généré pour votre compte.');
        
                    return $this->redirectToRoute('app_login');
            }


        }

        return $this->render('reset_password/reset_password.html.twig');
    }
}
