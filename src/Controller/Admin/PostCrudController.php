<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Title');
        yield ChoiceField::new('Type')
            ->setChoices([
                'Orbiter Session' => 'orbitersession',
                'Podcast' => 'podcast',
                'Radio' => 'radio',
                'Records' => 'records',
                'Windowlicker' => 'Windowlicker',
        ]);
        yield UrlField::new('URL');
        yield EasyMediaField::new('Image', "Image")
        // Apply restrictions by mime-types
        ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
        // Apply restrictions to upload size in MB
        ->setFormTypeOption("restrictions_uploadSize", 5.0)
        // Enable/Disable actions
        ->setFormTypeOption("editor", false)
        ->setFormTypeOption("upload", true)
        ->setFormTypeOption("bulk_selection", false)
        ->setFormTypeOption("move", false)
        ->setFormTypeOption("rename", true)
        ->setFormTypeOption("metas", true)
        ->setFormTypeOption("delete", true)
        ;
        yield DateField::new('Date');
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
