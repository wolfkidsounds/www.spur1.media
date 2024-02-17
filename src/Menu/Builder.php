<?php // src/Menu/Builder.php

namespace App\Menu;

use App\Entity\User;
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
                'icon' => 'fa-solid fa-home',
                'class' => '',
            ]
        ]);

        $menu->addChild('divider_custom_1', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Orbiter Session', [
            'route' => 'app_main_orbiter-session_index',
            'extras' => [
                'icon' => 'fa-solid fa-record-vinyl',
                'class' => '',
            ]
        ]);

        $menu->addChild('Podcast', [
            'route' => 'app_main_podcast_index',
            'extras' => [
                'icon' => 'fa-solid fa-podcast',
                'class' => '',
            ]
        ]);

        $menu->addChild('Radio', [
            'route' => 'app_main_radio_index',
            'extras' => [
                'icon' => 'fa-solid fa-radio',
                'class' => '',
            ]
        ]);

        $menu->addChild('Teletime', [
            'route' => 'app_main_teletime_index',
            'extras' => [
                'icon' => 'fa-solid fa-phone',
                'class' => '',
            ]
        ]);

        $menu->addChild('Windowlicker', [
            'route' => 'app_main_windowlicker_index',
            'extras' => [
                'icon' => 'fa-brands fa-windows',
            ]
        ]);

        $menu->addChild('divider_custom_2', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Producer Meeting', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Artist Database', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Events', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Records', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Player', [
            'route' => 'app_logout',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        return $menu;
    }
}