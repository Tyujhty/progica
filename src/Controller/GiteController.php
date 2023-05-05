<?php

namespace App\Controller;

use App\Entity\Shelter;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GiteController extends AbstractController
{
    #[Route('/gite/{id}', name: 'gite')]
    public function giteCard(Request $request, Shelter $shelter): Response
    {

        $formSearch = $this->createForm((SearchType::class));
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {

        };

        return $this->render('gite/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'shelter' => $shelter
        ]);
    }
}
