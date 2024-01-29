<?php // src/Controller/Artists/SingleController.php

namespace App\Controller\Artists;

use App\Controller\Artists\ArtistsController;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleController extends ArtistsController
{
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/page/single';
    }

    #[Route('/artist/{slug}', name: 'app_artists_single', methods: ['GET'])]
    public function single(string $slug, ArtistRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render($this->getPageTemplatePrefix() . '/artist.html.twig', [
            'post' => $post,
            'title' => 'Artist',
        ]);
    }
    
}