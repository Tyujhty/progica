<?php

namespace App\Controller;

use App\Entity\Shelter;
use App\Form\SearchType;
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
    public function shelterCard(Request $request, Shelter $shelter, EntityManagerInterface $em, int $id, SessionInterface $sessionInterface): Response
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
