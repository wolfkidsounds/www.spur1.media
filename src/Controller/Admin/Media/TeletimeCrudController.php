<?php

namespace App\Controller\Admin\Media;

use App\Entity\Teletime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

class TeletimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teletime::class;
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
        ->setFormTypeOption("restrictions_path", "Teletime/Thumbnails/")
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

        yield FormField::addFieldset('Relations');
        yield AssociationField::new('Artists')
        ->autocomplete()
        ->setColumns(8);
        yield AssociationField::new('Crews')
        ->autocomplete()
        ->setColumns(8);
        
        yield FormField::addFieldset('Resources');
        yield UrlField::new('YouTubeUrl', 'YouTube')
        ->hideOnIndex()
        ->setColumns(8);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['Title', 'Date', 'Artists.Name'])
            ->setDefaultSort(['Date' => 'DESC']);
    }
}
