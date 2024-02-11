<?php

namespace App\Controller\Admin\Artists;

use App\Entity\Crew;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CrewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Crew::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name')
            ->setColumns(8);

        yield SlugField::new('Slug')
            ->setTargetFieldName(['Name'])
            ->setColumns(8)
            ->hideOnIndex();
            
        yield FormField::addFieldset('Details');
        yield EasyMediaField::new('Image')
            ->setFormTypeOption('restrictions_uploadTypes', ["image/*"])
            ->setFormTypeOption('restrictions_path', 'Crews/Thumbnails/')
            ->setFormTypeOption('upload', true)
            ->setFormTypeOption('rename', true)
            ->setColumns(8);

        yield FormField::addRow();
        yield TextEditorField::new('Description')
            ->hideOnIndex()
            ->setColumns(8);

        yield FormField::addFieldset('Members');
        yield AssociationField::new('Artist')
            ->setColumns(8);

        yield FormField::addFieldset('Links');
        yield CollectionField::new('Links')
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
            ->useEntryCrudForm()
            ->hideOnIndex();

        yield FormField::addFieldset('Settings');
        yield AssociationField::new('Owner')
            ->setColumns(8);
    }

}
