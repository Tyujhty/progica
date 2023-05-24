<?php

namespace App\Controller;


use App\Form\SearchType;
use App\Repository\ShelterRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ShelterRepository $shelterRepository,SessionInterface $sessionInterface): Response
    {   
        
        $formSearch = $this->createForm(SearchType::class);
        $formSearch->handleRequest($request);

        $criteria = $formSearch->getData();
        $countShelters = 0;
        $differenceInDays = 0;

        $dateStart = $formSearch->get('start')->getData();
        $dateEnd = $formSearch->get('end')->getData();

        if ($dateStart instanceof \DateTimeInterface && $dateEnd instanceof \DateTimeInterface) {
            $selectedDateStart = $dateStart->format('Y-m-d');
            $selectedDateEnd = $dateEnd->format('Y-m-d');
            
            // Calcul de la différence en jours
            $differenceInDays = $dateEnd->diff($dateStart)->days;
    
            $sessionInterface->remove('selected_date_start');
            $sessionInterface->set('selected_date_start', $selectedDateStart);
            $sessionInterface->remove('selected_date_end');
            $sessionInterface->set('selected_date_end', $selectedDateEnd);
            $sessionInterface->remove('difference_in_days');
            $sessionInterface->set('difference_in_days', $differenceInDays);
        } else {
            $sessionInterface->remove('selected_date_start');
            $sessionInterface->remove('selected_date_end');
            $sessionInterface->remove('difference_in_days');
        }
        

        if ($criteria && ($criteria['town'] || $criteria['department'] || $criteria['region'] || (isset($criteria['interior']) && !$criteria['interior']->isEmpty()) || (isset($criteria['exterior']) && !$criteria['exterior']->isEmpty()) || (isset($criteria['services']) && !$criteria['services']->isEmpty()))) {

            $shelters = $shelterRepository->searchSheltersByCriteria($criteria);
            
            if($shelters) {
                $countShelters = count($shelters);
                // /users/default-profile.png
                // $this->addFlash('success', `Votre question a été ajoutée avec $countShelters`);
            }
        } else {

            $shelters = $shelterRepository->findAll();
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
            'shelters' => $shelters
        ]);
    }
    
}