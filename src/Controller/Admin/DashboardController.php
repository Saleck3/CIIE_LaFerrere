<?php

namespace App\Controller\Admin;

use App\Entity\Cohorte;
use App\Entity\Curso;
use App\Entity\Resolucion;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CIIE La ferrere')
            ->setFaviconPath('img/logo.svg')
            ->setDefaultColorScheme('dark')
            ->setLocales(['es', 'en']);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-chart-pie');
        if ($this->isGranted("ROLE_SUPER_ADMIN")) {
            yield MenuItem::linkToCrud('Usuarios', 'fas fa-user', User::class);
        }
        yield MenuItem::linkToCrud('Cohortes', 'fas fa-calendar-alt', Cohorte::class);
        yield MenuItem::linkToCrud('Cursos', 'fas fa-school', Curso::class);
        yield MenuItem::linkToCrud('Resoluciones', 'fas fa-school-circle-check', Resolucion::class);
        yield MenuItem::linkToRoute('Inicio', 'fa fa-home', 'app_home');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('d/M/Y');
    }
}
