<?php

namespace App\Controller;

use App\Entity\Shelter;
use App\Form\SearchType;
use App\Service\DateHandlerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShelterController extends AbstractController
{
    #[Route('/shelter/{id}', name: 'shelter_show')]
    public function shelterCard(Request $request, Shelter $shelter, EntityManagerInterface $em, int $id, SessionInterface $sessionInterface, DateHandlerService $dateHandlerService): Response
    {
        $user = $this->getUser();
        $shelter = $em->getRepository(Shelter::class)->find($id);

        $formSearch = $this->createForm((SearchType::class));
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $criteria = $formSearch->getData();

            $criteria = $request->query->all();

            return $this->redirectToRoute('home', $criteria);
        };

        $interiorEquipments = $shelter->getInteriorEquipment();
        $exteriorEquipments = $shelter->getExteriorEquipment();
        $services = $shelter->getServices();
        
        
        if ($request->get('ajax')) {

            $dateHandlerService->dateHandler($formSearch, $sessionInterface);

            return new JsonResponse([
                'content' => $this->renderView('_partials/_contentDateSearch.html.twig', [
                    'shelter' => $shelter

                ])
            ]);
        }

        return $this->render('shelter/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'user' => $user,
            'shelter' => $shelter,
            'interiorEquipments' => $interiorEquipments,
            'exteriorEquipments' => $exteriorEquipments,
            'services' => $services,
        ]);
    }

}
