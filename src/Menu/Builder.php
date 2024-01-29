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
            'route' => 'app_main_index',
            'extras' => [
                'icon' => 'fa-solid fa-record-vinyl',
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Podcast', [
            'route' => 'app_main_index',
            'extras' => [
                'icon' => 'fa-solid fa-podcast',
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Radio', [
            'route' => 'app_main_radio',
            'extras' => [
                'icon' => 'fa-solid fa-radio',
                'class' => '',
            ]
        ]);

        $menu->addChild('Teletime', [
            'route' => 'app_main_teletime',
            'extras' => [
                'icon' => 'fa-solid fa-phone',
                'class' => '',
            ]
        ]);

        $menu->addChild('Windowlicker', [
            'route' => 'app_main_windowlicker',
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
            'route' => 'app_main_index',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Artist Database', [
            'route' => 'app_main_index',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Events', [
            'route' => 'app_main_index',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Records', [
            'route' => 'app_main_index',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Player', [
            'route' => 'app_main_index',
            'extras' => [
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        return $menu;
    }

    public function navProfile(): ItemInterface
    {
        $menu = $this->factory->createItem('navProfile');

        $menu->addChild('Profile', [
            'route' => 'admin',
            'extras' => [
                'icon' => 'fa-solid fa-user',
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('Settings', [
            'route' => 'admin',
            'extras' => [
                'icon' => 'fa-solid fa-gear',
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('divider_custom_1', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Admin', [
            'route' => 'admin',
            'extras' => [
                'icon' => 'fa-solid fa-gauge'
            ]
        ]);

        $menu->addChild('Backstage', [
            'route' => 'app_main_index',
            'extras' => [
                'icon' => 'fa-solid fa-chart-pie',
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('API', [
            'route' => 'app_main_index',
            'extras' => [
                'icon' => 'fa-solid fa-code-compare',
                'class' => 'opacity-25 pe-none',
            ]
        ]);

        $menu->addChild('divider_custom_2', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Sign Out', [
            'route' => 'admin',
            'extras' => [
                'icon' => 'fa-solid fa-arrow-right-from-bracket'
            ]
        ]);

        return $menu;
    }
}