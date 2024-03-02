<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\ClaimRequest;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClaimArtistFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'Name',
                'autocomplete' => true,
            ])

            ->add('Info', CKEditorType::class, [
                'config' => [
                    'allowedContent' => 'p b i',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClaimRequest::class,
        ]);
    }
}
