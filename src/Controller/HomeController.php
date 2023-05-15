<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Form\ContactType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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

    #[Route('/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('home/mentions.html.twig', [
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

    #[Route('/ajoutstagiaire', name: 'app_ajoutstagiaire')]
    public function ajoutstagiaire(): Response
    {
        return $this->render('stagiaire/modif.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Envoyer l'e-mail de contact
            $message = (new Email('Nouveau message de contact'))
                ->setFrom($contact->getEmail())
                ->setTo('abdoulayekante863@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        ['contact' => $contact]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
