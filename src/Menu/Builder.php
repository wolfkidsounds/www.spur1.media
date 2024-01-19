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

        $menu->addChild('Orbiter Session', [
            'route' => 'app_main_orbitersession',
            'extras' => [
                'icon' => 'fa-solid fa-record-vinyl'
            ]
        ]);

        $menu->addChild('Podcast', [
            'route' => 'app_main_podcast',
            'extras' => [
                'icon' => 'fa-solid fa-podcast'
            ]
        ]);

        $menu->addChild('Radio', [
            'route' => 'app_main_radio',
            'extras' => [
                'icon' => 'fa-solid fa-radio'
            ]
        ]);

        $menu->addChild('Teletime', [
            'route' => 'app_main_radio',
            'extras' => [
                'icon' => 'fa-solid fa-phone'
            ]
        ]);

        $menu->addChild('Windowlicker', [
            'route' => 'app_main_windowlicker',
            'extras' => [
                'icon' => 'fa-brands fa-windows'
            ]
        ]);

        $menu->addChild('divider_custom_2', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Producer Meeting', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Artist Database', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Events', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Records', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Player', [
            'route' => 'app_main_index'
        ]);

        return $menu;
    }

    public function navProfile(): ItemInterface
    {
        $menu = $this->factory->createItem('navProfile');

        $menu->addChild('Profile', [
            'route' => 'admin',
            'extras' => [
                'icon' => 'fa-solid fa-user'
            ]
        ]);

        $menu->addChild('Settings', [
            'route' => 'admin',
            'extras' => [
                'icon' => 'fa-solid fa-gear'
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
                'icon' => 'fa-solid fa-gauge-high'
            ]
        ]);

        $menu->addChild('API', [
            'route' => 'app_main_index',
            'extras' => [
                'icon' => 'fa-solid fa-code-compare'
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