<?php

namespace App\Controller;


use App\Form\SearchType;
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
    public function index(Request $request,SessionInterface $sessionInterface, ShelterSearchService $shelterSearchService, DateHandlerService $dateHandlerService): Response
    {   
        $user = $this->getUser();
        $countShelters = 0;

        $formSearch = $this->createForm(SearchType::class);
        $formSearch->handleRequest($request);

        $criteria = $formSearch->getData();
        
        $shelters = $shelterSearchService->searchShelterByCriteria($criteria);
        
        $dateHandlerService->dateHandler($formSearch, $sessionInterface);
        
        if($shelters) {            
            $countShelters = count($shelters);
        }
        
        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('_partials/_content.html.twig', [
                    'shelters' => $shelters,
                    'countShelters' => $countShelters
                ])
            ]);
        }

        return $this->render('home/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'shelters' => $shelters,
            'user' => $user
        ]);
    }
}