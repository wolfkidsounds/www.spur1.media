<?php

namespace App\Form;

use App\Entity\Crew;
use App\Entity\Gender;
use App\Entity\ActType;
use App\Entity\ArtistType;
use App\Entity\City;
use App\Entity\State;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArtistFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', TextType::class, [
                'label' => 'Search Artist',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Search...',
                ]
            ])

            ->add('verified', CheckboxType::class, [
                'required' => false,
                'label'    => 'Show verified Artists only',
                'attr' => [
                ],
            ])

            ->add('artisttype', EntityType::class, [
                'label' => 'Artist Type',
                'required' => false,
                'class' => ArtistType::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'attr' => [
                    'data-controller' => 'select2',
                    'data-select' => 'true',
                    'placeholder' => 'Artist Type',
                ]
            ])

            ->add('acttype', EntityType::class, [
                'label' => 'Type of Act',
                'required' => false,
                'class' => ActType::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'attr' => [
                    'class' => '',
                    'data-controller' => 'select2',
                    'data-select' => 'true',
                    'placeholder' => 'Act Type',
                ]
            ])

            ->add('city', EntityType::class, [
                'label' => 'City',
                'required' => false,
                'class' => City::class,
                'multiple' => true,
                'attr' => [
                    'class' => '',
                    'data-controller' => 'select2',
                    'data-select' => 'true',
                    'placeholder' => 'City',
                ]
            ])

            ->add('gender', EntityType::class, [
                'label' => 'Gender',
                'required' => false,
                'class' => Gender::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'attr' => [
                    'class' => '',
                    'data-controller' => 'select2',
                    'data-select' => 'true',
                    'placeholder' => 'Gender',
                ]
            ])

            ->add('crew', EntityType::class, [
                'label' => 'Crew',
                'required' => false,
                'class' => Crew::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'attr' => [
                    'class' => '',
                    'data-controller' => 'select2',
                    'data-select' => 'true',
                    'placeholder' => 'Crew',
                ]
            ])

            ->add('reset', ResetType::class, [
                'label' => 'Reset Filters',
                'row_attr' => [
                    'class' => 'd-inline-block me-3',
                ],
                'attr' => [
                    'class' => 'btn btn-danger text-white rounded-1',
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Apply Filters',
                'row_attr' => [
                    'class' => 'd-inline-block',
                ],
                'attr' => [
                    'class' => 'btn btn-secondary text-white rounded-1',
                    'data-action' => 'artist-filter#submitForm',
                ]
            ])

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
