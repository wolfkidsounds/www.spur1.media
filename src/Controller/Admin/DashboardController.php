<?php

namespace App\Controller\Admin;

use App\Entity\ActType;
use App\Entity\Tag;
use App\Entity\Crew;
use App\Entity\User;
use App\Entity\Radio;
use App\Entity\Artist;
use App\Entity\ArtistType;
use App\Entity\City;
use App\Entity\Club;
use App\Entity\Country;
use App\Entity\Gender;
use App\Entity\Interview;
use App\Entity\Podcast;
use App\Entity\LinkType;
use App\Entity\Location;
use App\Entity\Teletime;
use App\Entity\NebenDerSpur;
use App\Entity\TagFormat;
use App\Entity\Windowlicker;
use App\Entity\OrbiterSession;
use App\Entity\RecSession;
use App\Entity\State;
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

        if($this->featureManager->isEnabled('content') || $this->featureManager->isEnabled('debug')) {
            yield MenuItem::section('Content')
                ->setPermission('ROLE_ACCESS_MEDIA');

            yield MenuItem::subMenu('Spur1-Media', 'fa-solid s1 s1-icon s1-logo')
                ->setPermission('ROLE_ACCESS_MEDIA')
                ->setSubItems([
                    MenuItem::linkToCrud('Radio', 'fa fa-radio', Radio::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_RADIO'),
                    MenuItem::linkToCrud('Windowlicker', 'fa-brands fa-windows', Windowlicker::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_WINDOWLICKER'),
                    MenuItem::linkToCrud('Orbiter Session', 'fa-solid fa-record-vinyl', OrbiterSession::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_ORBITERSESSION'),
                    MenuItem::linkToCrud('Teletime', 'fa-solid fa-phone', Teletime::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_TELETIME'),
                    MenuItem::linkToCrud('Podcast', 'fa-solid fa-podcast', Podcast::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_PODCAST'),
                    MenuItem::linkToCrud('Neben Der Spur', 'fa fa-shuffle', NebenDerSpur::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_NEBENDERSPUR'),
                    MenuItem::linkToCrud('Rec Session', 'fa fa-circle-play', RecSession::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_RECSESSION'),
                    MenuItem::linkToCrud('Interview', 'fa fa-microphone', Interview::class)
                        ->setPermission('ROLE_ACCESS_MEDIA_INTERVIEW'),
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
                    MenuItem::linkToCrud('Artists', 'fa fa-user', Artist::class)
                        ->setPermission('ROLE_ACCESS_ARTISTS'),
                    MenuItem::linkToCrud('Crews', 'fa fa-users', Crew::class)
                        ->setPermission('ROLE_ACCESS_CREWS'),
                    MenuItem::linkToCrud('Artist Types', 'fa fa-user-tag', ArtistType::class)
                        ->setPermission('ROLE_ACCESS_ARTISTS'),
                    MenuItem::linkToCrud('Act Types', 'fa fa-user-tag', ActType::class)
                        ->setPermission('ROLE_ACCESS_ARTISTS'),
                    
            ]);

            yield MenuItem::subMenu('Spur1-Player', 'fa fa-play')
                ->setPermission('ROLE_ACCESS_PLAYER')
                ->setSubItems([
                    MenuItem::linkToRoute('Spur1-Player', 'fa fa-play', 'admin_play')
                        ->setPermission('ROLE_ACCESS_PLAYER'),
            ]);
        }

        yield MenuItem::section('Design & Media');
        yield MenuItem::linkToRoute('Media Files', 'fa fa-picture-o', 'media.index');

        yield MenuItem::section('Cloud')
            ->setPermission('ROLE_ACCESS_CLOUD');
        yield MenuItem::linkToRoute('Spur1-Cloud', 'fa fa-cloud', 'admin_cloud')
            ->setPermission('ROLE_ACCESS_CLOUD');
        yield MenuItem::linkToRoute('Spur1-API', 'fa fa-server', 'admin_api')
            ->setPermission('ROLE_ACCESS_API');

        yield MenuItem::section('Settings');
        yield MenuItem::subMenu('Tags', 'fa fa-tags')
            ->setPermission('ROLE_ACCESS_MEDIA')
            ->setSubItems([
                MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class),
                MenuItem::linkToCrud('Tag-Formats', 'fa fa-tag', TagFormat::class)
            ]);
        yield MenuItem::subMenu('Geo Locations', 'fa fa-location-dot')
            ->setPermission('ROLE_ACCESS_MEDIA')
            ->setSubItems([
                MenuItem::linkToCrud('Countries', 'fa fa-location-dot', Country::class),
                MenuItem::linkToCrud('States', 'fa fa-location-dot', State::class),
                MenuItem::linkToCrud('Cities', 'fa fa-location-dot', City::class),
            ]);
        yield MenuItem::subMenu('Content Settings', 'fa fa-gear')
            ->setPermission('ROLE_ACCESS_MEDIA')
            ->setSubItems([
                MenuItem::linkToCrud('Link Type', 'fa fa-link', LinkType::class),
                MenuItem::linkToCrud('Genders', 'fa fa-venus-mars', Gender::class),
                MenuItem::linkToCrud('Clubs', 'fa fa-industry', Club::class),
            ]);

        yield MenuItem::section('System');
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
            ->setPermission('ROLE_ADMIN');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Back to Spur1-Media', 'fa-solid fa-arrow-left', 'app_main_index'),
            ])
            ->displayUserAvatar(false);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addWebpackEncoreEntry('admin');
    }
}
