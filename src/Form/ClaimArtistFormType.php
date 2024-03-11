<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\ClaimRequest;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ClaimArtistFormType extends AbstractType
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'Name',
                'autocomplete' => true,
            ])

            ->add('Info', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Provide some Information to validate you are the owner of this artist accout (email, instagram, linktr.ee)',
                ]
            ])

            ->add('Mail', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'E-Mail',
                ]
            ])

            ->add('Submit', ButtonType::class, [
                'label' => 'Claim',
                'attr' => [
                    'type' => 'button',
                    'class' => 'btn btn-primary text-white',
                    'data-controller' => 'modal',
                    'data-action' => 'modal#submitForm',
                    'data-modal-resolve-value' => 'claim',
                ]
            ])

            ->add('Cancel', ButtonType::class, [
                'label' => 'Close',
                'attr' => [
                    'type' => 'button',
                    'class' => 'btn btn-secondary text-white',
                    'data-bs-dismiss' => 'modal',
                ]                
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
