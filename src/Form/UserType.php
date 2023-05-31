<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom *',
                'constraints' => [
                    new NotBlank([
                        "message" => "Veuillez saisir votre prénom.",
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le prénom doit contenir {{ limit }} caractères minimum',
                        'maxMessage' => 'Le prénom ne doit dépasser {{ limit }} caractères'
                    ]),
                    new Regex([
                        'pattern' => "/^[A-Za-z]+$/",
                        'message' => 'Le prénom ne peut contenir que des lettres.'
                    ])
                ],
            ])

            ->add('lastName', TextType::class, [
                'label' => 'Votre nom *',
                'constraints' => [
                    new NotBlank([
                        "message" => "Veuillez saisir votre nom.",
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le nom doit contenir {{ limit }} caractères minimum',
                        'maxMessage' => 'Le nom ne doit dépasser {{ limit }} caractères'
                    ]),
                    new Regex([
                        'pattern' => "/^[A-Za-z]+$/",
                        'message' => 'Le nom ne peut contenir que des lettres.'
                    ])
                ],
            ])

            ->add('address', TextType::class, [
                'label' => 'Votre adresse *',
                'constraints' => [
                    new NotBlank([
                        "message" => "Veuillez saisir votre adresse.",
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => "L'adresse doit contenir {{ limit }} caractères minimum",
                        'maxMessage' => "L'adresse ne doit dépasser {{ limit }} caractères"
                    ])
                ],
            ])
            
            ->add('email', EmailType::class, [
                'label' => 'Votre email *',
                'constraints' => [
                    new NotBlank([
                        "message" => "Veuillez saisir votre email."
                    ]),
                    new Email([
                        "message" => "L'email '{{ value }}' n'est pas valide.",
                        "mode" => "strict"
                    ])
                ]
            ])

            ->add('phone', TextType::class, [
                'label' => 'Votre numéro de téléphone *',
                'constraints' => [
                    new NotBlank([
                        "message" => "Veuillez saisir votre numéro de téléphone.",
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => "Le numéro de téléphone doit contenir {{ limit }} chiffres minimum",
                        'maxMessage' => "Le numéro de téléphone ne doit dépasser {{ limit }} chiffres"
                    ])
                ],
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être identique',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Répéter votre mot de passe *'],
                'constraints' => [
                    new Assert\Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins 8 caractères'
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                        'message' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre, un caractère spécial.'
                    ])
                ]
            ])

            ->add('avatarFile', FileType::class, [
                'label' => 'Choisir une image de profil (optionnel)', 
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '1M',
                        'maxSizeMessage' => 'Votre image fait {{size}}. La limite est de {{limit}} {{suffix}}'
                    ])
                ]
            ]);  
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
