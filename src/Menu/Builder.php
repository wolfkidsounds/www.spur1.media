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

    public function navMain(): ItemInterface
    {
        $menu = $this->factory->createItem('navMain');

        $menu->addChild('Home', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('divider_custom_1', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Orbiter Session', [
            'route' => 'app_main_orbitersession'
        ]);

        $menu->addChild('Podcast', [
            'route' => 'app_main_podcast'
        ]);

        $menu->addChild('Radio', [
            'route' => 'app_main_radio'
        ]);

        $menu->addChild('Windowlicker', [
            'route' => 'app_main_windowlicker'
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

        $menu->addChild('Archive', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Player', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('divider_custom_3', [
            'divider' => true, 
            'extras' => [
                'divider' => true
            ]
        ]);

        $menu->addChild('Login/Register', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Admin', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('Backstage', [
            'route' => 'app_main_index'
        ]);

        $menu->addChild('API', [
            'route' => 'app_main_index'
        ]);

        return $menu;
    }
}