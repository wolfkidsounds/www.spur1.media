<?php

namespace App\Controller\Admin\Artists;

use App\Entity\ActType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ActType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Name')
            ->setColumns(8);
        yield TextField::new('Icon')
            ->setColumns(8);
    }
}
