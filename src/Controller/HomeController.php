<?php

namespace App\Controller;


use App\Form\SearchType;
use App\Repository\ShelterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ShelterRepository $shelterRepository): Response
    {

        $formSearch = $this->createForm((SearchType::class));
        $formSearch->handleRequest($request);

        
        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $criteria = $formSearch->getData();
            $shelters = $shelterRepository->searchShelterFromTown($criteria);
            dd($shelters);
        }
        
        $shelters = $shelterRepository->findAll();

        if($request->get('ajax')) {
            
        }

        return $this->render('home/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'shelters' => $shelters
        ]);
    }
}
