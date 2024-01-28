<?php // src/Controller/PageController.php

namespace App\Controller\Main;

use App\Repository\PostRepository;
use App\Repository\RadioRepository;
use App\Controller\Main\MainController;
use App\Repository\WindowlickerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends MainController
{
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/page';
    }

    #[Route('/', name: 'app_main_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render($this->getPageTemplatePrefix() . '/index.html.twig', [
            'title' => 'News',
        ]);
    }

    #[Route('/radio', name: 'app_main_radio', methods: ['GET'])]
    public function radio(RadioRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/radio.html.twig', [
            'posts' => $posts,
            'title' => 'Radio',
        ]);
    }

    #[Route('/windowlicker', name: 'app_main_windowlicker', methods: ['GET'])]
    public function windowlicker(WindowlickerRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/windowlicker.html.twig', [
            'posts' => $posts,
            'title' => 'Windowlicker',
        ]);
    }
    
}