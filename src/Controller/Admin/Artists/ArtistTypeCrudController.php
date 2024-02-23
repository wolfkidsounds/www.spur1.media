<?php

namespace App\Controller\Admin\Artists;

use App\Entity\ArtistType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtistTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArtistType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name')
            ->setColumns(8);
    }
}
