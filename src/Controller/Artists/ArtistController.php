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

    #[Route('/artist/edit/{id}', name: 'app_artist_edit', methods: ['GET'])]
    public function artist_edit(int $id, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['id' => $id]);
        $posts = $artist->getPosts()->toArray();

        return $this->render('section/artist/page/artist/edit.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }

    #[Route('/artist/claim/{slug}', name: 'app_artist_claim', methods: ['GET'])]
    public function artist_claim(string $slug, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['slug' => $slug]);
        $posts = $artist->getPosts()->toArray();

        return $this->render('section/artist/page/artist/claim.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }
    
}