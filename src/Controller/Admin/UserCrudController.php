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
            'Administrator' => 'ROLE_ADMIN',
            'Benutzer' => 'ROLE_USER',
            'Editor' => 'ROLE_EDITOR',
            '_MEDIA' => 'ACCESS_MEDIA',
            '_RECORDS' => 'ACCESS_RECORDS',
            '_EVENTS' => 'ACCESS_EVENTS',
            '_API' => 'ACCESS_API',
            '_ARTISTS' => 'ACCESS_ARTISTS',
            '_PLAYER' => 'ACCESS_PLAYER',
            '_CLOUD' => 'ACCESS_CLOUD',
        ]);
        yield TextField::new('password', 'Passwort')
        ->hideOnIndex()
        ->setColumns(3);
    }
}
