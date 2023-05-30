<?php

namespace App\Controller;

use App\Entity\Shelter;
use App\Form\SearchType;
use App\Service\DateHandlerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShelterController extends AbstractController
{
    #[Route('/shelter/{id}', name: 'shelter_show')]
    public function shelterCard(Request $request, Shelter $shelter, SessionInterface $sessionInterface, DateHandlerService $dateHandlerService, RequestStack $requestStack): Response
    {
        $user = $this->getUser();

        $interiorEquipmentsList = $shelter->getInteriorEquipment();
        $exteriorEquipmentsList = $shelter->getExteriorEquipment();
        $servicesList = $shelter->getServices();

        $formSearch = $this->createForm((SearchType::class));
        $formSearch->handleRequest($request);

        
        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            
            $criteria = $formSearch->getData();
            $criteria = $request->query->all();
            
            return $this->redirectToRoute('home', $criteria);
        };
        
        if ($request->get('ajax')) {
            
            $dateHandlerService->dateHandler($formSearch, $sessionInterface);
            
            return new JsonResponse([
                'content' => $this->renderView('_partials/_contentDateSearch.html.twig', [
                    'shelter' => $shelter
                    ])
                ]);
            }
        
        $previousUrl = $requestStack->getMainRequest()->headers->get('referer');

        return $this->render('shelter/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'user' => $user,
            'shelter' => $shelter,
            'interiorEquipments' => $interiorEquipmentsList,
            'exteriorEquipments' => $exteriorEquipmentsList,
            'services' => $servicesList,
            'previousUrl' => $previousUrl
        ]);
    } 
}
