<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'Choisir une région'
                ]
                )
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder'=> 'Choisir un département'
            ])

            ->add('start', DateType::class, [
                'widget' => 'single_text',
                'model_timezone' => 'Europe/Paris',
                'view_timezone' => 'Europe/Paris',
                'required' => false,
                'label' => false
            ])
            ->add('end', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => false
            ])
            ->add('interior', ChoiceType::class, [
                'choices' => [
                    'Télévision' => 'tv',
                    'Lave-vaisselle' => 'laveVaisselle',
                    'Lave-linge' => 'laveLinge',
                    'Climatisation' => 'climatisation'
                ],
                'multiple' => true,
                'expanded' => true,
                'label' => false
            ])
            ->add('exterior', ChoiceType::class, [
                'choices' => [
                    'Terrasse' => 'terrasse',
                    'Barbecue' => 'barbecue',
                    'Piscine' => 'piscine',
                    'Tennis' => 'tennis',
                    'Ping-pong' => 'pingPong'
                ],
                'multiple' => true,
                'expanded' => true,
                'label' => false
            ])
            ->add('services', ChoiceType::class, [
                'choices' => [
                    'Location de linge' => 'locLinge',
                    'Ménage' => 'menage',
                    'Accès internet' => 'internet',
                ],
                'multiple' => true,
                'expanded' => true,
                'label' => false
            ])

            ->add('rechercher', SubmitType::class, [
                'row_attr' => [
                    'class' => 'font-bold btn btn-secondary mr-4'
                ]
            ])
            ->add('filtres', ButtonType::class, [
                'row_attr' => [
                    'class' => 'font-bold btn btn-primary btn-filter'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
