<?php

namespace App\Controller\Admin\Settings;

use App\Entity\Club;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Club::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name');
        yield UrlField::new('MapsUrl');
        yield EasyMediaField::new('Image')
            ->setFormTypeOption('restrictions_uploadTypes', ["image/*"])
            ->setFormTypeOption('restrictions_path', 'Clubs/Thumbnails/')
            ->setFormTypeOption('upload', true)
            ->setFormTypeOption('rename', true);
        yield TextEditorField::new('Description');
        yield CollectionField::new('Links')
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
            ->useEntryCrudForm()
            ->hideOnIndex();
    }
}
