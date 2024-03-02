<?php

namespace App\Controller\Admin\Notification;

use App\Entity\Notification;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NotificationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Notification::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General');
        yield ChoiceField::new('Level');
        yield TextEditorField::new('Text');
        yield AssociationField::new('User');

        yield FormField::addFieldset('Meta');
        yield ChoiceField::new('Status')
        ->setDisabled()
        ->hideOnIndex()
        ->setColumns(2);
        yield DateTimeField::new('createdAt')
            ->setDisabled()
            ->hideOnIndex()
            ->setColumns(2);
    }
}
