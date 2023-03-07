<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\PostCategory;
use App\Entity\Teaser;
use App\Entity\TeaserCategory;
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
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Главная', 'fa fa-home');
        yield MenuItem::linkToCrud('Категории постов', 'fa-solid fa-file', PostCategory::class);
        yield MenuItem::linkToCrud('Посты', 'fa-solid fa-file', Post::class);
        yield MenuItem::linkToCrud('Категории тизеров', 'fa-solid fa-file', TeaserCategory::class);
        yield MenuItem::linkToCrud('Тизеры', 'fa-solid fa-file', Teaser::class);
    }
}
