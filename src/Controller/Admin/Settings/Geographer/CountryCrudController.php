<?php

namespace App\Controller\Admin\Settings\Geographer;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CountryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $jsonLoad = Action::new('JSON_LOADER', 'Upload Json')
            ->displayAsLink()
            ->linkToRoute('admin_json_loader')
            ->createAsGlobalAction();

        return $actions
            ->add(Crud::PAGE_INDEX, $jsonLoad)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name');
        yield TextField::new('Code');
        yield AssociationField::new('States');
        yield AssociationField::new('Cities');
    }
}
