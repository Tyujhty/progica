<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SearchType;
use App\Form\UserType;
use App\Repository\ShelterRepository;
use App\Service\UploadImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    /** @var User $user */
    
    #[Route('/profile', name: 'profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profileShow(ShelterRepository $shelterRepository, Request $request, UploadImageService $uploadImageService, EntityManagerInterface $em): Response
    {

        $formSearch = $this->createForm((SearchType::class));

        $user = $this->getUser();
        $shelter = $shelterRepository->findBy(['user' => $user]);

        $formProfile = $this->createForm(UserType::class, $user);
        $formProfile->remove('firstName');
        $formProfile->remove('lastName');
        $formProfile->remove('address');
        $formProfile->remove('email');
        $formProfile->remove('phone');
        $formProfile->remove('password');
        $formProfile->handleRequest($request);
        
        if ($formProfile->isSubmitted()&& $formProfile->isValid()) {

            $avatarFile = $formProfile->get('avatarFile')->getData();

            if($avatarFile) {
                if($user instanceof User) {
                $user->setAvatar($uploadImageService->uploadProfileImage($avatarFile, $user->getAvatar() ));
                }
                $em->flush();
            }
        };

        return $this->render('profile/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'formProfile' => $formProfile->createView(),
            'user' => $user,
            'shelters' => $shelter
        ]);
    }
}
