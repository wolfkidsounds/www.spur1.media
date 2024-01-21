<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Radio;
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
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
            ->setPermission('ROLE_ADMIN');     

        if($this->featureManager->isEnabled('content')) {
            yield MenuItem::section('Spur1-Media')
                ->setPermission('ACCESS_MEDIA');

            yield MenuItem::subMenu('Spur1-Media', 'spur1-icon spur1-logo')
                ->setPermission('ACCESS_MEDIA')
                ->setSubItems([
                    MenuItem::linkToCrud('Radio', 'fa fa-radio', Radio::class)->setPermission('ACCESS_MEDIA_RADIO')
            ]);
        }

        if($this->featureManager->isEnabled('records')){
            yield MenuItem::section('Spur1-Records')
                ->setPermission('ACCESS_RECORDS');
            yield MenuItem::linkToRoute('Spur1-Records', 'fa fa-record-vinyl', 'admin_records')
                ->setPermission('ACCESS_RECORDS');
            yield MenuItem::linkToRoute('Spur1-Backstage', 'fa fa-chart-pie', 'admin_backstage')
                ->setPermission('ACCESS_BACKSTAGE');
        }

        if($this->featureManager->isEnabled('events')){
            yield MenuItem::section('Spur1-Events')
                ->setPermission('ACCESS_EVENTS');
            yield MenuItem::linkToRoute('Spur1-Events', 'fa fa-calendar-days', 'admin_events')
                ->setPermission('ACCESS_EVENTS');
        }

        if($this->featureManager->isEnabled('api')){
            yield MenuItem::section('Spur1-API')
                ->setPermission('ACCESS_API');
            yield MenuItem::linkToRoute('Spur1-API', 'fa fa-server', 'admin_api')
                ->setPermission('ACCESS_API');
        }

        if($this->featureManager->isEnabled('artists')) {
            yield MenuItem::section('Spur1-Artist Database')
                ->setPermission('ACCESS_ARTISTS');
            yield MenuItem::linkToRoute('Spur1-Artist Database', 'fa fa-database', 'admin_artists')
                ->setPermission('ACCESS_ARTISTS');
        }

        if($this->featureManager->isEnabled('player')) {
            yield MenuItem::section('Spur1-Player')
                ->setPermission('ACCESS_PLAYER');
            yield MenuItem::linkToRoute('Spur1-Player', 'fa fa-play', 'admin_play')
                ->setPermission('ACCESS_PLAYER');
        }

        if($this->featureManager->isEnabled('cloud')) {
            yield MenuItem::section('Spur1-Cloud')
                ->setPermission('ACCESS_CLOUD');
            yield MenuItem::linkToRoute('Spur1-Cloud', 'fa fa-cloud', 'admin_cloud')
                ->setPermission('ACCESS_CLOUD');
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
