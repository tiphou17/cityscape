<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Property;
use App\Entity\Category;
use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('bundles/EasyAdminBundle/page/login.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cityscape');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Projet', 'fas fa-diagram-project', Project::class);
        yield MenuItem::linkToCrud('Propriété', 'fas fa-campground', Property::class);
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-table', Category::class);
        yield MenuItem::linkToCrud('Picture', 'fas fa-table', Picture::class);
        yield MenuItem::linkToCrud('Adresse', 'fa fa-map-location', Address::class);
    }
}
