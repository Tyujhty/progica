<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\ExteriorEquipment;
use App\Entity\InteriorEquipment;
use App\Entity\Region;
use App\Entity\Service;
use App\Entity\Town;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                'placeholder' => 'Choisir une région',
                'required' => false
                ]
                )
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder'=> 'Choisir un département',
                'required' => false
            ])
            ->add('town', EntityType::class, [
                'class' => Town::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder'=> 'Choisir une ville',
                'required' => false
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

            ->add('interior', EntityType::class, [
                'class' => InteriorEquipment::class,
                'choice_label' => 'name',
                'label' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])

            ->add('exterior', EntityType::class, [
                'class' => ExteriorEquipment::class,
                'choice_label' => 'name',
                'label' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])

            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'name',
                'label' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr' => ['id' => 'searchForm'],
            'method' => 'GET'
        ]);
    }
}
