<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
        ->setColumns(3);
        yield EmailField::new('email', 'E-Mail')
        ->setColumns(3);

        yield FormField::AddRow();
        yield ChoiceField::new('roles', 'Rollen')
        ->setColumns(3)
        ->allowMultipleChoices()
        ->renderAsBadges()
        ->setChoices([
            'Benutzer' => 'ROLE_USER',

            'Access Spur1-Admin' => 'ROLE_ADMIN',
            'All-Access Spur1-Media' => 'ACCESS_MEDIA',
            'Access Spur1-Radio' => 'ACCESS_MEDIA_RADIO',

            'All-Access Spur1-Records' => 'ACCESS_RECORDS',
            'All-Access Spur1-Events' => 'ACCESS_EVENTS',
            'All-Access Spur1-Api' => 'ACCESS_API',
            'All-Access Spur1-Artists' => 'ACCESS_ARTISTS',
            'All-Access Spur1-Player' => 'ACCESS_PLAYER',
            'All-Access Spur1-Cloud' => 'ACCESS_CLOUD',
        ]);
        yield TextField::new('password', 'Passwort')
        ->hideOnIndex()
        ->setColumns(3);
    }
}
