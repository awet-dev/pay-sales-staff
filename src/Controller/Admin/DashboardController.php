<?php

namespace App\Controller\Admin;

use App\Entity\Bonus;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\Salary;
use App\Entity\Transaction;
use App\Entity\User;
use App\Repository\BonusRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
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

    #[Route('/payment/request/{type}', name: 'payment_request')]
    public function paymentRequest($type, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        foreach ($users as $user) {
            $salary = new Salary();
            if ($type === 'salary') {
                $salary->setAmount("100000");
            } else {
                $bonuses = $user->getBonuses();
                $totalBonus = 0;
                foreach ($bonuses as $bonus) {
                    $totalBonus += $bonus->getAmount();
                }
                $salary->setAmount($totalBonus);
            }
            $salary->setUser($user);
            $salary->setType($type);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salary);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin');
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

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Payroll Sales Staff')
            // you can include HTML contents too (e.g. to link to an image)
            //->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('image/favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('admin')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
            ;
    }

}
