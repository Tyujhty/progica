<?php

namespace App\Controller;

use App\Entity\Shelter;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\ShelterRepository;
use App\Service\UploadImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    /** @var User $user */
    
    #[Route('/profile', name: 'profile_current_user')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profileShow(ShelterRepository $shelterRepository, Request $request, UploadImageService $uploadImageService, EntityManagerInterface $em): Response
    {        
        $currentUser = $this->getUser();
        $shelter = $shelterRepository->findBy(['user' => $currentUser]);
        
        $formProfile = $this->createForm(UserType::class, $currentUser);
        
        $editFormProfile = $this->createFormBuilder()
        ->add('description', TextareaType::class, [
            'label' => false,
            'empty_data' => 'Ajouter votre description...',
            'required' => false
        ])
        ->getForm();

                
        $fieldsToRemove = ['firstName', 'lastName', 'address', 'email', 'phone', 'password'];
        
        foreach ($fieldsToRemove as $field) {
            $formProfile->remove($field);
        }
        
        $formProfile->handleRequest($request);
        
        if ($formProfile->isSubmitted()&& $formProfile->isValid()) {
            
            $avatarFile = $formProfile->get('avatarFile')->getData();

            if($avatarFile) {
                if($currentUser instanceof User) {
                    $currentUser->setAvatar($uploadImageService->uploadProfileImage($avatarFile, $currentUser->getAvatar() ));
                }
                $em->flush();
            }
        };

        $this->editDescription($currentUser, $editFormProfile, $request, $em);

        return $this->render('profile/profile.html.twig', [
            'formProfile' => $formProfile->createView(),
            'editFormProfile' => $editFormProfile->createView(),
            'user' => $currentUser,
            'shelters' => $shelter
        ]);
    }

    public function editDescription($user,$editFormProfile,$request, $em)
    {

        if ($user instanceof User) {
            $editFormProfile->setData([
                'description' => $user->getDescription()
            ]);
        }
        
        $editFormProfile->handleRequest($request);
        
        if ($editFormProfile->isSubmitted() && $editFormProfile->isValid()) {
            $newDesc = $editFormProfile->get('description')->getData();
            if ($newDesc) {
                if($user instanceof User) {
                    $user->setDescription($newDesc);
                    $em->flush();
                }
            }
        } 
    }

    #[Route('/profile/{id}', name: 'profile_user')]
    public function userProfile(User $user): Response
    {
        $currentUser = $this->getUser();

        if ($currentUser === $user) {
            return $this->redirectToRoute('profile_current_user');
        }

        return $this->render('profile/profile_public.html.twig', ['user' => $user, 'currentUser' => $currentUser]);

    }
}
