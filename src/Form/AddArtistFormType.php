<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Crew;
use App\Entity\Artist;
use App\Entity\Gender;
use App\Form\LinkType;
use App\Entity\ActType;
use App\Entity\ArtistType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AddArtistFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Name',
                ]
            ])
            ->add('Slug', TextType::class, [
                'label' => false,
                'row_attr' => [],
                'attr' => [
                    'class' => 'form-control form-control-sm disabled',
                    'readonly' => true,
                    'placeholder' => 'Slug',
                ],
            ])
            ->add('Image', FileType::class, [
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Image',
                ]
            ])
            ->add('Crews', EntityType::class, [
                'label' => false,
                'class' => Crew::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'autocomplete' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Select Crews'
                ]
            ])
            ->add('Gender', EntityType::class, [
                'label' => false,
                'class' => Gender::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'autocomplete' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Selecte Genders'
                ]
            ])
            ->add('ArtistType', EntityType::class, [
                'label' => false,
                'class' => ArtistType::class,
                'choice_label' => 'Name',
                'autocomplete' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Select Artist Types'
                ]
            ])
            ->add('ActType', EntityType::class, [
                'label' => false,
                'class' => ActType::class,
                'choice_label' => 'Name',
                'multiple' => true,
                'autocomplete' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Select Act Types'
                ]
            ])
            ->add('City', EntityType::class, [
                'label' => false,
                'class' => City::class,
                'choice_label' => 'Name',
                'autocomplete' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Select City',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
