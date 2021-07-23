<?php

namespace App\Controller\Admin;

use App\Entity\Salary;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class SalaryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Salary::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('paidAt')->hideOnForm(),
            MoneyField::new('amount')->setCurrency('EUR'),
            AssociationField::new('user'),
            ChoiceField::new('type')->setChoices([
                'Salary' => 'salary',
                'Bonus' => 'bonus'
            ])
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE, Action::EDIT);
    }
}
