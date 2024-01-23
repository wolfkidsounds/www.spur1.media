<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
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
        yield TextField::new('Name', 'Name')
        ->setColumns(4);
        yield EmailField::new('email', 'E-Mail')
        ->setColumns(4);

        yield FormField::AddRow();
        yield ChoiceField::new('roles', 'Rollen')
        ->setColumns(8)
        ->allowMultipleChoices()
        ->renderAsBadges()
        ->setChoices([
            'Benutzer' => 'ROLE_USER',

            'Access Spur1-Admin' => 'ROLE_ADMIN',
            'All-Access Spur1-Media' => 'ROLE_ACCESS_MEDIA',
            'Access Spur1-Radio' => 'ROLE_ACCESS_MEDIA_RADIO',

            'Developer' => 'ROLE_DEV',

            'All-Access Spur1-Records' => 'ROLE_ACCESS_RECORDS',
            'All-Access Spur1-Events' => 'ROLE_ACCESS_EVENTS',
            'All-Access Spur1-Api' => 'ROLE_ACCESS_API',
            'All-Access Spur1-Artists' => 'ROLE_ACCESS_ARTISTS',
            'All-Access Spur1-Player' => 'ROLE_ACCESS_PLAYER',
            'All-Access Spur1-Cloud' => 'ROLE_ACCESS_CLOUD',
        ]);

        yield FormField::addRow();
        yield EasyMediaField::new('Image')
        ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
        ->setFormTypeOption("restrictions_path", "Users/Thumbnails/")
        ->setFormTypeOption("upload", true)
        ->setFormTypeOption("rename", true)
        ->setFormTypeOption("metas", true)
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
