<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::AddRow();
        yield TextField::new('Name', 'Name')
        ->setColumns(4);
        yield EmailField::new('email', 'E-Mail')
        ->setColumns(4);

        yield FormField::AddRow();
        yield SlugField::new('Slug')
        ->setTargetFieldName(['Name'])
        ->setColumns(8)
        ->hideOnIndex();

        yield FormField::AddRow();
        yield ChoiceField::new('roles', 'Rollen')
        ->setColumns(8)
        ->allowMultipleChoices()
        ->renderAsBadges()
        ->setChoices([
            'User' => 'ROLE_USER',
            'Creator' => 'ROLE_CREATOR',
            'Administrator' => 'ROLE_ADMIN',

            'Access: Media' => 'ROLE_ACCESS_MEDIA',
            'Access: Artists' => 'ROLE_ACCESS_ARTISTS',
            'Access: Crews' => 'ROLE_ACCESS_CREWS',

            'Developer' => 'ROLE_DEV',
        ]);

        yield FormField::addRow();
        yield EasyMediaField::new('Image')
        ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
        ->setFormTypeOption("restrictions_path", "Users/Thumbnails/")
        ->setFormTypeOption("upload", true)
        ->setFormTypeOption("rename", true)
        ->setFormTypeOption("metas", true)
        ->setFormTypeOption("move", true)
        ->hideOnIndex()
        ->setColumns(8);

        yield FormField::addRow();
        yield TextField::new('password')
        ->setFormType(RepeatedType::class)
        ->setFormTypeOptions([
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => '(Repeat Password)'],
            'mapped' => false,
        ])
        ->setRequired($pageName === Crud::PAGE_NEW)
        ->onlyOnForms()
        ->setColumns('col-6 col-6');
    }
}
