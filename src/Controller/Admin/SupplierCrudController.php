<?php

namespace App\Controller\Admin;

use App\Entity\Supplier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SupplierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Supplier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            CountryField::new('country'),
            TextField::new('bank_account'),
            ChoiceField::new('user_role')->setChoices([
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_SUPPLIER' => 'ROLE_SUPPLIER'
            ])
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission('new', 'ROLE_ADMIN')
            ->setPermission('delete', 'ROLE_ADMIN')
            ->setPermission('edit', 'ROLE_ADMIN');
    }
}
