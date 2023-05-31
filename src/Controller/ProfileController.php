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
    
    #[Route('/profile', name: 'profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profileShow(ShelterRepository $shelterRepository, Request $request, UploadImageService $uploadImageService, EntityManagerInterface $em): Response
    {        
        $user = $this->getUser();
        $shelter = $shelterRepository->findBy(['user' => $user]);
        
        $formProfile = $this->createForm(UserType::class, $user);
        
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
                if($user instanceof User) {
                $user->setAvatar($uploadImageService->uploadProfileImage($avatarFile, $user->getAvatar() ));
                }
                $em->flush();
            }
        };

        $this->editDescription($user, $editFormProfile, $request, $em);

        return $this->render('profile/index.html.twig', [
            'formProfile' => $formProfile->createView(),
            'editFormProfile' => $editFormProfile->createView(),
            'user' => $user,
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
    // #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function userProfile(User $user): Response
    {
        $currentUser = $this->getUser();

        if ($currentUser === $user) {
            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/_show.html.twig', ['user' => $user, 'currentUser' => $currentUser]);

    }
}
