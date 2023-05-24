<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ShelterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profileShow(ShelterRepository $shelterRepository): Response
    {
        $formSearch = $this->createForm((SearchType::class));

        $user = $this->getUser();
        $shelter = $shelterRepository->findBy(['user' => $user]);

        return $this->render('profile/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'user' => $user,
            'shelters' => $shelter
        ]);
    }
}
