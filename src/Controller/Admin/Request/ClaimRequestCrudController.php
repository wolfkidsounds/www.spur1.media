<?php

namespace App\Controller\Admin\Request;

use App\Config\ClaimStatus;
use App\Entity\ClaimRequest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClaimRequestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClaimRequest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('Request Information');
        yield AssociationField::new('User')
            ->setColumns(4)
            ->autocomplete();
        yield AssociationField::new('Artist')
            ->setColumns(4)
            ->autocomplete();
        
        yield TextAreaField::new('Info')
            ->setDisabled(true)
            ->setColumns(8)
            ->hideOnIndex();
        
        yield FormField::addFieldset('Request Response');
        yield ChoiceField::new('Status')
            ->setColumns(6)
            ->renderAsBadges();

        yield FormField::addRow();
        yield TextEditorField::new('Reason')
            ->setColumns(6)
            ->hideOnIndex();
        
        yield DateTimeField::new('createdAt')
            ->setDisabled()
            ->hideOnForm();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC']);
    }
}
