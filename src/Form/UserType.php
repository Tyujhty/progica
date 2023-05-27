<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom *'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom *'
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse *'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email *'
            ])
            ->add('phone', TextType::class, [
                'label' => 'Votre numéro de téléphone *'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être identique',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Répéter votre mot de passe *'],
            ])
            ->add('avatarFile', FileType::class, [
                'label' => 'Choisir une image de profil (optionnel)', 
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'mimeTypesMessage' => 'Veuillez uploader une image',
                        'maxSize' => '1M',
                        'maxSizeMessage' => 'Votre image fait {{size}}. La limite est de {{limit}} {{suffix}}'
                    ])
                ]
                ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
