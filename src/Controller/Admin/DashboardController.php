<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Main\Post;
use App\Entity\Main\Type;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Novaway\Bundle\FeatureFlagBundle\Manager\FeatureManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private $featureManager;
    public function __construct(FeatureManager $featureManager) {
        $this->featureManager = $featureManager;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Spur1-Dashboard')
            ->renderSidebarMinimized(false)
            ->renderContentMaximized(true)
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-gauge');

        yield MenuItem::section('System');
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);

        if($this->isGranted('ROLE_SUPERADMIN') && $this->featureManager->isEnabled('admin')){
            
        }

        if($this->isGranted('ACCESS_MEDIA') && $this->featureManager->isEnabled('main')){
            yield MenuItem::section('Spur1-Media');
            yield MenuItem::subMenu('Spur1-Media', 'fa fa-home')
            ->setSubItems([
                MenuItem::linkToCrud('Posts', 'fa fa-list', Post::class),
                MenuItem::linkToCrud('Types', 'fa fa-list', Type::class),
            ]);
            yield MenuItem::linkToRoute('Spur1-Archive', 'fa fa-box-archive', 'admin_archive');
        }

        if($this->isGranted('ACCESS_RECORDS') && $this->featureManager->isEnabled('records')){
            yield MenuItem::section('Spur1-Records');
            yield MenuItem::linkToRoute('Spur1-Records', 'fa fa-record-vinyl', 'admin_records');
            yield MenuItem::linkToRoute('Spur1-Backstage', 'fa fa-chart-pie', 'admin_backstage');
        }

        if($this->isGranted('ACCESS_EVENTS') && $this->featureManager->isEnabled('events')){
            yield MenuItem::section('Spur1-Events');
            yield MenuItem::linkToRoute('Spur1-Events', 'fa fa-calendar-days', 'admin_events');
        }

        if($this->isGranted('ACCESS_API') && $this->featureManager->isEnabled('api')){
            yield MenuItem::section('Spur1-API');
            yield MenuItem::linkToRoute('Spur1-API', 'fa fa-server', 'admin_api');
        }

        if($this->isGranted('ACCESS_ARTISTS') && $this->featureManager->isEnabled('artists')){
            yield MenuItem::section('Spur1-Artist Database');
            yield MenuItem::linkToRoute('Spur1-Artist Database', 'fa fa-database', 'admin_artists');
        }

        if($this->isGranted('ACCESS_PLAYER') && $this->featureManager->isEnabled('player')){
            yield MenuItem::section('Spur1-Player');
            yield MenuItem::linkToRoute('Spur1-Player', 'fa fa-play', 'admin_play');
        }

        if($this->isGranted('ACCESS_CLOUD') && $this->featureManager->isEnabled('cloud')){
            yield MenuItem::section('Spur1-Cloud');
            yield MenuItem::linkToRoute('Spur1-Cloud', 'fa fa-cloud', 'admin_cloud');
        }
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Back to Spur1-Media', 'fa-solid fa-arrow-left', 'app_main_index'),
            ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addWebpackEncoreEntry('admin');
    }
}
