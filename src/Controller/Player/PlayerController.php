<?php // src/Controller/PlayerController.php

namespace App\Controller\Player;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', host: 'play.%app.host%')]
class PlayerController extends BaseController
{
    protected function getTemplatePrefix(): string
    {
        return 'Player';
    }
    
}