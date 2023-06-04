<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/forgot-password", name="forgot_password")
     */
    public function forgotPassword(
        Request $request,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    ): Response {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');

            $user = $userRepository->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'Adresse e-mail non trouvée.');
                return $this->redirectToRoute('forgot_password');
            }

            // Génération d'un nouveau mot de passe aléatoire
            $newPassword = bin2hex(random_bytes(8));
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Un nouveau mot de passe a été généré pour votre compte.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/reset_password.html.twig');
    }
}
