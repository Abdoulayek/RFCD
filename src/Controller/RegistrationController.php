<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactFormType;
use App\Entity\Stagiaires;
use App\Form\StagiaireFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{

    private ?UserRepository $repository;

    public function __construct(ManagerRegistry $manager)
    {
        $this->repository = $manager->getRepository(User::class);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    
    #[Route('/user/{id}/update', name: 'update_post', methods:['GET', 'POST'], requirements:['id' => "\d+"])]
    public function update(User $user, Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->repository->add($user, true);
            return $this->redirectToRoute('app_account');
        }

        return $this->renderForm('home/edit.html.twig', [
            'registrationForm' => $form
        ]);
    }

    #[Route('/stage', name: 'app_stage')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
       
        $stagiaire = new Stagiaires();
       
        $form = $this->createForm(StagiaireFormType::class, $stagiaire);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $user = $this->getUser();
            $stagiaire->setRelationuser($user);
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            $this->addFlash('success', 'Votre stagiaire a été ajouté');
        return $this->redirectToRoute('app_stage');
        }
  
        return $this->render('stagiaire/index.html.twig', [
            'stagiaireForm' => $form -> createView(),
        ]);
    }

    #[Route('/liste/{id}', name: 'app_liste')]

    public function action(ManagerRegistry $doctrine, $id): Response
    {
       

        $user = $doctrine->getRepository(User::class)->find($id);
        $liste = $doctrine->getRepository(Stagiaires::class)->findBy(['Relationuser'=>$user]);

        
    
         
    return $this->render('stagiaire/show.html.twig', [
        'liste' => $liste
    ]);

}  

#[Route('/contact', name: 'app_contact')]
public function contact(Request $request, MailerInterface $mailer)
{
    $form = $this->createForm(ContactFormType::class);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $contactFormData = $form->getData();
        $message = (new Email())
            ->from($contactFormData['nom'])
            ->to('abdoulayekante863@gmail.com')
            ->subject('Choix Certificateur de ' .$contactFormData['nom'])
            ->text( $contactFormData['formateur'],
                'text/plain');
        $mailer->send($message);
        $this->addFlash('success', 'Votre choix a été pris en compte');
        return $this->redirectToRoute('app_contact');
    }
    return $this->render('home/contact.html.twig', [
        'our_form' => $form->createView()
    ]);
}
}
