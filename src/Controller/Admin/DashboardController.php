<?php

namespace App\Controller\Admin;

use App\Entity\Bonus;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\Salary;
use App\Entity\Transaction;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
//        if ('admin@gmail.com' === $this->getUser()->getUsername()) {
//            return $this->redirect('admin');
//        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Payroll Sales Staff');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Supplier', 'fas fa-people-carry', User::class);
        yield MenuItem::linkToCrud('Customer', 'fas fa-users', Customer::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-truck-loading', Product::class);
        yield MenuItem::linkToCrud('Transaction', 'fas fa-shopping-cart', Transaction::class);
        yield MenuItem::linkToCrud('Bonus', 'fas fa-comment-dollar', Bonus::class);
        yield MenuItem::linkToCrud('Salary', 'fas fa-money-check-alt', Salary::class);
    }
}
