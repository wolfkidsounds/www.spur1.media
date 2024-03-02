<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Club;
use App\Entity\Crew;
use App\Entity\Link;
use App\Entity\LinkType;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Url')
            ->add('Type', EntityType::class, [
                'class' => LinkType::class,
                'choice_label' => 'Name',
            ])

            // ->add('Artist', EntityType::class, [
            //     'class' => Artist::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('Crew', EntityType::class, [
            //     'class' => Crew::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('Post', EntityType::class, [
            //     'class' => Post::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('Club', EntityType::class, [
            //     'class' => Club::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}
