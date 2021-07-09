<?php

namespace App\Controller\Admin;

use App\Entity\Bonus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BonusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bonus::class;
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
