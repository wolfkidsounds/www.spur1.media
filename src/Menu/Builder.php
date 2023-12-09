<?php // src/Menu/Builder.php

namespace App\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuBuilder extends AbstractController
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function sidebar(): ItemInterface
    {
        $menu = $this->factory->createItem('navigation');

        $menu->addChild('OrbiterSession', [
            'route' => 'app_orbitersession'
        ]);

        $menu->addChild('Podcast', [
            'route' => 'app_podcast'
        ]);

        $menu->addChild('Radio', [
            'route' => 'app_radio'
        ]);

        $menu->addChild('Records', [
            'route' => 'app_records'
        ]);

        $menu->addChild('Windowlicker', [
            'route' => 'app_windowlicker'
        ]);

        return $menu;
    }
}