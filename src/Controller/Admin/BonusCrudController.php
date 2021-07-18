<?php

namespace App\Controller\Admin;

use App\Entity\Bonus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\Form\FormInterface;

class BonusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bonus::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('addAt')->hideOnForm(),
            MoneyField::new('amount')->setCurrency('EUR')->hideOnForm(),
            AssociationField::new('user'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE, Action::EDIT);
    }

}
