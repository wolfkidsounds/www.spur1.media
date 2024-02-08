<?php // src/Controller/TeletimeController.php

namespace App\Controller\Main;

use App\Repository\TeletimeRepository;
use App\Controller\Main\MainController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeletimeController extends MainController
{
    #[Route('/teletime', name: 'app_main_teletime_index', methods: ['GET'])]
    public function teletime_index(TeletimeRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/teletime/index.html.twig', [
            'posts' => $posts,
            'title' => 'Teletime',
        ]);
    }

    #[Route('/teletime/{slug}', name: 'app_main_teletime_single', methods: ['GET'])]
    public function teletime_single(string $slug, TeletimeRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/teletime/single.html.twig', [
            'post' => $post,
            'title' => 'Teletime',
        ]);
    }
    
}