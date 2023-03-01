<?php

namespace App\Controller\Admin;

use App\Entity\Achievements;
use App\Entity\ProfessionalExperience;
use App\Entity\Project;
use App\Entity\Skills;
use App\Entity\Training;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Compétence', 'fa-solid fa-jedi', Skills::class);
        yield MenuItem::linkToCrud('Projets', 'fa-solid fa-briefcase', Project::class);
        yield MenuItem::linkToCrud('Experience pro', 'fa-solid fa-user-tie', ProfessionalExperience::class);
        yield MenuItem::linkToCrud('Ecole', 'fa-solid fa-school', Training::class);
        yield MenuItem::linkToCrud('Réalisation', 'fa-solid fa-star', Achievements::class);
    }
}
