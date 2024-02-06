<?php // src/Controller/Artists/PageController.php

namespace App\Controller\Artists;

use App\Controller\Artists\ArtistsController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends ArtistsController
{
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/page';
    }

    #[Route('/', name: 'app_artists_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render($this->getPageTemplatePrefix() . '/index.html.twig', [
            'title' => 'Artists',
        ]);
    }
    
}