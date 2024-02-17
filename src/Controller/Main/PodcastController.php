<?php // src/Controller/PodcastController.php

namespace App\Controller\Main;

use App\Repository\PodcastRepository;
use App\Controller\Main\MainController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PodcastController extends MainController
{
    #[Route('/podcast', name: 'app_main_podcast_index', methods: ['GET'])]
    public function podcast_index(PodcastRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/podcast/index.html.twig', [
            'posts' => $posts,
            'title' => 'Podcast',
        ]);
    }

    #[Route('/podcast/{slug}', name: 'app_main_podcast_single', methods: ['GET'])]
    public function podcast_single(string $slug, PodcastRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/podcast/single.html.twig', [
            'post' => $post,
            'title' => 'Podcast',
        ]);
    }
    
}