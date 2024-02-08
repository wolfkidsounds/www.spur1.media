<?php // src/Controller/WindowlickerController.php

namespace App\Controller\Main;

use App\Repository\RadioRepository;
use App\Controller\Main\MainController;
use App\Repository\WindowlickerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WindowlickerController extends MainController
{
    #[Route('/windowlicker', name: 'app_main_windowlicker_index', methods: ['GET'])]
    public function windowlicker_index(WindowlickerRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/windowlicker/index.html.twig', [
            'posts' => $posts,
            'title' => 'Windowlicker',
        ]);
    }

    #[Route('/windowlicker/{slug}', name: 'app_main_windowlicker_single', methods: ['GET'])]
    public function windowlicker_single(string $slug, WindowlickerRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/windowlicker/single.html.twig', [
            'post' => $post,
            'title' => 'Windowlicker',
        ]);
    }
    
}