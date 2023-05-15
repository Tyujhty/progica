<?php

namespace App\Controller;

use App\Entity\Shelter;
use App\Form\SearchType;
use App\Repository\ShelterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GiteController extends AbstractController
{
    #[Route('/gite/{id}', name: 'gite_show')]
    public function giteCard(Request $request, Shelter $shelter, EntityManagerInterface $em, int $id, ShelterRepository $shelterRepository): Response
    {
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


        return $this->render('gite/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'shelter' => $shelter,
            'interiorEquipments' => $interiorEquipments,
            'exteriorEquipments' => $exteriorEquipments,
            'services' => $services
        ]);
    }
}
