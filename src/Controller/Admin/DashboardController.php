<?php

namespace App\Controller\Admin;

use App\Entity\Artical;
use App\Entity\Categorie;
use App\Entity\Categories;
use App\Entity\Produit;
use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            ->setTitle('ProjectVendApi');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categorie', 'fa fa-archive', Categories::class);
        yield MenuItem::linkToCrud('Produit', 'fa fa-newspaper-o', Produits::class);
        yield MenuItem::linkToCrud('Produit', 'fa fa-newspaper-o', Artical::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
