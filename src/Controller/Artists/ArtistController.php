<?php // src/Controller/Artist.php

namespace App\Controller\Artists;

use App\Controller\BaseController;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends BaseController
{
    #[Route('/artist', name: 'app_artist_index', methods: ['GET'])]
    public function artist_index(): Response
    {
        return $this->render('section/artist/page/artist/index.html.twig', [
            'title' => 'Artist',
        ]);
    }

    #[Route('/artist/{slug}', name: 'app_artist_single', methods: ['GET'])]
    public function artist_single(string $slug, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['Slug' => $slug]);
        $posts = $artist->getPosts()->toArray();

        return $this->render('section/artist/page/artist/single.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }
    
}