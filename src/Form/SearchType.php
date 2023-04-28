<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
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
            ->add('content', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ville, région, département...'
                ]

            ])
            ->add('people', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Nb d'adultes",
                    'min' => 0,
                    'max' => 100,
                ]

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
