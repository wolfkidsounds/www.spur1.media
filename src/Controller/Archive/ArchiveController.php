<?php // src/Controller/ArchiveController.php

namespace App\Controller\Archive;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', host: 'archive.%app.host%')]
class ArchiveController extends BaseController
{
    protected function getTemplatePrefix(): string
    {
        return 'Archive';
    }
    
}