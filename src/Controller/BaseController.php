<?php // src/Controller/BaseController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected function getCurrentHost(): string
    {
        return $this->getParameter('HOST');
    }
}   