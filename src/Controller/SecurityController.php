<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SearchType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/signin', name: 'signin')]
    public function signin(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $formSearch = $this->createForm((SearchType::class));

        $user = new User();

        $signinForm = $this->createForm(UserType::class, $user);
        $signinForm->handleRequest($request);

        if($signinForm->isSubmitted() && $signinForm->isValid()) {
            
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('security/signin.html.twig', [
            'formSearch' => $formSearch->createView(),
            'signinForm' => $signinForm->createView()    
        ]);
    }
 
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $formSearch = $this->createForm((SearchType::class));

        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'formSearch' => $formSearch->createView(),
            'error' => $error,
            'username' => $username

        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        
    }

    // public function searchShelter(Request $request)
    // {



    //     return $this->render('security/signin.html.twig', [
            
    //     ]);
    // }
}
