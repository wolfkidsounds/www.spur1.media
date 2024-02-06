<?php

namespace App\Controller\Admin\Media;

use App\Entity\OrbiterSession;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrbiterSessionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrbiterSession::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addFieldset('General Information');
        yield TextField::new('Title')
        ->setColumns(7);
        yield DateField::new('Date')
        ->setColumns(1);
        yield SlugField::new('Slug')
        ->setTargetFieldName(['Date', 'Title'])
        ->setColumns(8)
        ->hideOnIndex();

        yield FormField::addRow();
        yield EasyMediaField::new('Image')
        ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
        ->setFormTypeOption("restrictions_path", "Radio/Thumbnails/")
        ->setFormTypeOption("upload", true)
        ->setFormTypeOption("rename", true)
        ->setFormTypeOption("metas", true)
        ->setFormTypeOption("move", true)
        ->hideOnIndex()
        ->setColumns(8);

        yield FormField::addRow();
        yield TextEditorField::new('Description')
        ->hideOnIndex()
        ->setColumns(8);

        yield AssociationField::new('Tags')
        ->autocomplete()
        ->hideOnIndex()
        ->setColumns(8);

        yield FormField::addFieldset('Artists');
        yield AssociationField::new('Artists')
        ->autocomplete()
        ->setColumns(8);
        
        yield FormField::addFieldset('Resources');
        yield FormField::addRow();
        yield UrlField::new('YouTubeUrl', 'YouTube')
        ->hideOnIndex()
        ->setColumns(8);
    }
}
