<?php //src/Controller/Admin/Artists/ArtistCrudController.php

namespace App\Controller\Admin\Artists;

use App\Entity\Link;
use App\Entity\Artist;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArtistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artist::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General Information');
        yield TextField::new('Name');

        yield SlugField::new('Slug')
            ->setTargetFieldName(['Name'])
            ->setColumns(8)
            ->hideOnIndex();

        yield FormField::addFieldset('Details');
        yield EasyMediaField::new('Image')
            ->setFormTypeOption('restrictions_uploadTypes', ["image/*"])
            ->setFormTypeOption('restrictions_path', 'Artists/Thumbnails/')
            ->setFormTypeOption('upload', true)
            ->setFormTypeOption('rename', true)
            ->setColumns(8);

        yield FormField::addRow();
        yield TextEditorField::new('Description')
            ->hideOnIndex()
            ->setColumns(8);

        yield FormField::addFieldset('Groups');
        yield AssociationField::new('Crews')
            ->hideOnIndex()
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

        yield FormField::addFieldset('Meta');
        yield DateTimeField::new('createdAt')
            ->setDisabled()
            ->hideOnIndex()
            ->setColumns(1);
        yield DateTimeField::new('editedAt')
            ->setDisabled()
            ->hideOnIndex()
            ->setColumns(1);
    }
}
