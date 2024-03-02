<?php // src/Menu/Builder.php

namespace App\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Builder extends AbstractController
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function navSidebar(): ItemInterface
    {
        $menu = $this->factory->createItem('navSidebar');

        $menu->addChild('Home', [
            'route' => 'app_main_index',
            'extras' => [
                'icon' => 'fa-solid fa-home w-16',
                'class' => '',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Home',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('divider_custom_1', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ],
        ]);

        $menu->addChild('Orbiter Session', [
            'route' => 'app_main_orbiter-session_index',
            'extras' => [
                'icon' => 'fa-solid fa-record-vinyl w-16',
                'class' => '',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Orbiter Session',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Podcast', [
            'route' => 'app_main_podcast_index',
            'extras' => [
                'icon' => 'fa-solid fa-podcast w-16',
                'class' => '',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Podcast',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Radio', [
            'route' => 'app_main_radio_index',
            'extras' => [
                'icon' => 'fa-solid fa-radio w-16',
                'class' => '',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Radio',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Teletime', [
            'route' => 'app_main_teletime_index',
            'extras' => [
                'icon' => 'fa-solid fa-phone w-16',
                'class' => '',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Teletime',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Windowlicker', [
            'route' => 'app_main_windowlicker_index',
            'extras' => [
                'class' => '',
                'icon' => 'fa-brands fa-windows w-16',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Windowlicker',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Neben Der Spur', [
            'route' => 'app_main_neben-der-spur_index',
            'extras' => [
                'icon' => 'fa-solid fa-shuffle w-16',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Neben Der Spur',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Rec Session', [
            'route' => 'app_main_rec-session_index',
            'extras' => [
                'icon' => 'fa-solid fa-circle-play w-16',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Rec Session',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Interview', [
            'route' => 'app_main_interview_index',
            'extras' => [
                'class' => 'pe-none opacity-25',
                'icon' => 'fa-solid fa-microphone w-16',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Interview',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('divider_custom_2', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Artists', [
            'route' => 'app_artist_index',
            'extras' => [
                'icon' => 'fa-solid fa-icons w-16',
                'class' => '',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Artists',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('Crews', [
            'route' => 'app_crew_index',
            'extras' => [
                'icon' => 'fa-solid fa-users w-16',
                'class' => 'opacity-25 pe-none',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Crews',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('divider_custom_3', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Producer Meeting', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'Producer Meeting',
                'data-bs-placement' => 'right',
            ],
        ]);

        $menu->addChild('SPUR1-RECORDS', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ],
            'linkAttributes' => [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => 'SPUR1-RECORDS',
                'data-bs-placement' => 'right',
            ],
        ]);

        return $menu;
    }
}