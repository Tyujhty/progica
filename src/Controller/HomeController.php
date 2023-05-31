<?php

namespace App\Controller;


use App\Form\SearchType;
use App\Repository\ShelterRepository;
use App\Service\DateHandlerService;
use App\Service\ShelterSearchService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request,SessionInterface $sessionInterface, ShelterSearchService $shelterSearchService, DateHandlerService $dateHandlerService, ShelterRepository $shelterRepository): Response
    {   
        $user = $this->getUser();

        $formSearch = $this->createForm(SearchType::class);
        $formSearch->handleRequest($request);
        
        $criteria = $formSearch->getData();
        
        $shelters = $shelterSearchService->searchShelterByCriteria($criteria);
        
        $dateHandlerService->dateHandler($formSearch, $sessionInterface);

        $totalShelters = $shelterRepository->count([]);
        
        if ($request->get('ajax')) {           

            return new JsonResponse([
                'content' => $this->renderView('home/_home_search_results_dynamic.html.twig', [
                    'criteria' => $criteria,
                    'shelters' => $shelters,
                    'countShelters' => count($shelters),
                    'totalShelters' => $totalShelters
                    ])
                ]);
        }

        return $this->render('home/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'shelters' => $shelters,
            'user' => $user,
        ]);
    }
    
}

