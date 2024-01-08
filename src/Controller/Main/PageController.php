<?php // src/Controller/PageController.php

namespace App\Controller\Main;

use App\Repository\PostRepository;
use App\Controller\Main\MainController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends MainController
{
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/page';
    }

    #[Route('/', name: 'app_main_index', methods: ['GET'])]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findBy([],['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/index.html.twig', [
            'posts' => $posts,
            'title' => 'News',
        ]);
    }

    #[Route('/podcast', name: 'app_main_podcast', methods: ['GET'])]
    public function podcast(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'podcast'], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/podcast.html.twig', [
            'posts' => $posts,
            'title' => 'Podcast',
        ]);
    }

    #[Route('/radio', name: 'app_main_radio', methods: ['GET'])]
    public function radio(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'radio'], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/radio.html.twig', [
            'posts' => $posts,
            'title' => 'Radio',
        ]);
    }

    #[Route('/windowlicker', name: 'app_main_windowlicker', methods: ['GET'])]
    public function windowlicker(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'windowlicker'], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/windowlicker.html.twig', [
            'posts' => $posts,
            'title' => 'Windowlicker',
        ]);
    }

    #[Route('/orbiter-session', name: 'app_main_orbitersession', methods: ['GET'])]
    public function orbitersession(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'orbitersession'], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/orbitersession.html.twig', [
            'posts' => $posts,
            'title' => 'Orbiter Session',
        ]);
    }
    
}