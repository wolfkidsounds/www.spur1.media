<?php // src/Controller/BackstageController.php

namespace App\Controller\Backstage;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', host: 'backstage.%app.host%')]
class BackstageController extends BaseController
{
    protected function getTemplatePrefix(): string
    {
        return 'Backstage';
    }
    
}