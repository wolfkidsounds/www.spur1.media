<?php // src/Controller/ArtistsController.php

namespace App\Controller\Artists;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

class ArtistsController extends BaseController
{
    protected function getTemplatePrefix(): string
    {
        return 'Artists';
    }
    
}