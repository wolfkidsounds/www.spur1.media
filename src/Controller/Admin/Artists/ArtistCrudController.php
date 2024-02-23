<?php //src/Controller/Admin/Artists/ArtistCrudController.php

namespace App\Controller\Admin\Artists;

use App\Entity\Link;
use App\Entity\Artist;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
        yield TextField::new('Name')
        ->setColumns(8);

        yield SlugField::new('Slug')
            ->setTargetFieldName(['Name'])
            ->setColumns(8)
            ->hideOnIndex();

        yield FormField::addRow();
        yield BooleanField::new('isVerified');

        yield FormField::addFieldset('Details');
        yield AssociationField::new('ArtistType')
            ->hideOnIndex()
            ->setColumns(2);
        yield AssociationField::new('ActType')
            ->hideOnIndex()
            ->setColumns(3);
        yield AssociationField::new('Gender')
            ->hideOnIndex()
            ->setColumns(3);

        yield FormField::addRow();
        yield TextEditorField::new('Description')
            ->hideOnIndex()
            ->setColumns(8);
        yield FormField::addRow();
        yield EasyMediaField::new('Image')
            ->setFormTypeOption('restrictions_uploadTypes', ["image/*"])
            ->setFormTypeOption('restrictions_path', 'Artists/Thumbnails/')
            ->setFormTypeOption('upload', true)
            ->setFormTypeOption('rename', true)
            ->setColumns(8);
        

        yield FormField::addFieldset('Groups');
        yield AssociationField::new('Crews')
            ->hideOnIndex()
            ->setColumns(8);

        yield FormField::addFieldset('Links');
        yield UrlField::new('Tourbox')
            ->setColumns(8)
            ->hideOnIndex();
        yield FormField::addRow();
        yield CollectionField::new('Links')
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
            ->useEntryCrudForm()
            ->setColumns(8)
            ->hideOnIndex();

        yield FormField::addFieldset('Settings');
        yield AssociationField::new('Owner')
            ->setColumns(8);

        yield FormField::addFieldset('Meta');
        yield DateTimeField::new('createdAt')
            ->setDisabled()
            ->hideOnIndex()
            ->setColumns(2);
        yield DateTimeField::new('editedAt')
            ->setDisabled()
            ->hideOnIndex()
            ->setColumns(2);
    }
}
