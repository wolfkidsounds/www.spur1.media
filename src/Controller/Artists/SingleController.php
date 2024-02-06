<?php // src/Controller/Artists/SingleController.php

namespace App\Controller\Artists;

use App\Controller\Artists\ArtistsController;
use App\Repository\ArtistRepository;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleController extends ArtistsController
{
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/page/single';
    }

    #[Route('/artist/{slug}', name: 'app_artists_single', methods: ['GET'])]
    public function single(string $slug, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['Slug' => $slug]);
        $posts = $artist->getPosts()->toArray();

        return $this->render($this->getPageTemplatePrefix() . '/artist.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }
    
}