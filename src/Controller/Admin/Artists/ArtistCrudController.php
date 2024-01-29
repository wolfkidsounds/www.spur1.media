<?php

namespace App\Controller\Admin\Artists;

use App\Entity\Artist;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArtistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artist::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name');

        yield SlugField::new('Slug')
            ->setTargetFieldName(['Name'])
            ->setColumns(8)
            ->hideOnIndex();
            
        yield FormField::addRow();
        yield EasyMediaField::new('Image')
            ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
            ->setFormTypeOption("restrictions_path", "Artists/Thumbnails/")
            ->setFormTypeOption("upload", true)
            ->setFormTypeOption("rename", true)
            ->setFormTypeOption("metas", true)
            ->setFormTypeOption("move", true)
            ->setColumns(8);

        yield FormField::addRow();
        yield TextEditorField::new('Description')
            ->hideOnIndex()
            ->setColumns(8);

        yield FormField::addRow();
        yield UrlField::new('SoundcloudUrl')
            ->hideOnIndex()
            ->setColumns(2);
        yield UrlField::new('YouTubeUrl')
            ->hideOnIndex()
            ->setColumns(2);
        yield UrlField::new('FacebookUrl')
            ->hideOnIndex()
            ->setColumns(2);
        yield UrlField::new('InstagramUrl')
            ->hideOnIndex()
            ->setColumns(2);
    }
}
