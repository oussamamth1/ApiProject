<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }
  
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ApiProject');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('category', 'fa fa-tags', Category::class);
        yield MenuItem::linkToCrud('Productes', 'fa fa-file-text', Product::class);
        if($this->IsGranted('ROLE_ADMIN')){    yield MenuItem::linkToCrud('Productes', 'fa fa-user', User::class);}
    
    }
}
