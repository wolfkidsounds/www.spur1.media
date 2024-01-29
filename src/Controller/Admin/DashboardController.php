<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Radio;
use App\Entity\Artist;
use App\Entity\Location;
use App\Entity\Teletime;
use App\Entity\Main\Post;
use App\Entity\Main\Type;
use App\Entity\TagFormat;
use App\Entity\Windowlicker;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-gauge');

        yield MenuItem::section('System');
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
            ->setPermission('ROLE_ADMIN');
        yield MenuItem::subMenu('Settings', 'fa fa-gear')
            ->setPermission('ROLE_ACCESS_MEDIA')
            ->setSubItems([
                MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class)
                    ->setPermission('ROLE_ACCESS_MEDIA'),
                MenuItem::linkToCrud('Tag-Formats', 'fa fa-tag', TagFormat::class)
                    ->setPermission('ROLE_ACCESS_MEDIA')
        ]);
        
        

        if($this->featureManager->isEnabled('content') || $this->featureManager->isEnabled('debug')) {
            yield MenuItem::section('Content')
                ->setPermission('ROLE_ACCESS_MEDIA');

            yield MenuItem::subMenu('Spur1-Media', 'spur1-icon spur1-logo')
                ->setPermission('ROLE_ACCESS_MEDIA')
                ->setSubItems([
                    MenuItem::linkToCrud('Radio', 'fa fa-radio', Radio::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_RADIO'),
                    MenuItem::linkToCrud('Windowlicker', 'fa-brands fa-windows', Windowlicker::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_WINDOWLICKER'),
                    MenuItem::linkToCrud('Locations', 'fa fa-location-dot', Location::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_WINDOWLICKER'),
                    MenuItem::linkToCrud('Teletime', 'fa-solid fa-phone', Teletime::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_TELETIME'),
            ]);

            yield MenuItem::subMenu('Spur1-Records', 'fa fa-record-vinyl')
                ->setPermission('ROLE_ACCESS_RECORDS')
                ->setSubItems([
                    MenuItem::linkToRoute('Spur1-Records', 'fa fa-record-vinyl', 'admin_records')
                        ->setPermission('ROLE_ACCESS_RECORDS'),
                    MenuItem::linkToRoute('Spur1-Backstage', 'fa fa-chart-pie', 'admin_backstage')
                        ->setPermission('ROLE_ACCESS_BACKSTAGE'),
            ]);

            yield MenuItem::subMenu('Spur1-Events', 'fa fa-calendar-days')
                ->setPermission('ROLE_ACCESS_EVENTS')
                ->setSubItems([
                    MenuItem::linkToRoute('Spur1-Events', 'fa fa-calendar-days', 'admin_events')
                        ->setPermission('ROLE_ACCESS_EVENTS'),
            ]);

            yield MenuItem::subMenu('Spur1-Artists', 'fa fa-database')
                ->setPermission('ROLE_ACCESS_ARTISTS')
                ->setSubItems([
                    MenuItem::linkToCrud('Artists', 'fa fa-music', Artist::class)
                        ->setPermission('ROLE_ACCESS_ARTISTS'),
            ]);

            yield MenuItem::subMenu('Spur1-Player', 'fa fa-play')
                ->setPermission('ROLE_ACCESS_PLAYER')
                ->setSubItems([
                    MenuItem::linkToRoute('Spur1-Player', 'fa fa-play', 'admin_play')
                        ->setPermission('ROLE_ACCESS_PLAYER'),
            ]);
        }

        yield MenuItem::section('Media');
        yield MenuItem::linkToRoute('Medias', 'fa fa-picture-o', 'media.index');

        yield MenuItem::section('Cloud')
            ->setPermission('ROLE_ACCESS_CLOUD');
        yield MenuItem::linkToRoute('Spur1-Cloud', 'fa fa-cloud', 'admin_cloud')
            ->setPermission('ROLE_ACCESS_CLOUD');
        yield MenuItem::linkToRoute('Spur1-API', 'fa fa-server', 'admin_api')
            ->setPermission('ROLE_ACCESS_API');
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
