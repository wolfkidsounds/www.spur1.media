<?php // src/Controller/RadioController.php

namespace App\Controller\Main;

use App\Repository\RadioRepository;
use App\Controller\Main\MainController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RadioController extends MainController
{
    #[Route('/radio', name: 'app_main_radio_index', methods: ['GET'])]
    public function radio_index(RadioRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/radio/index.html.twig', [
            'posts' => $posts,
            'title' => 'Radio',
        ]);
    }

    #[Route('/radio/{slug}', name: 'app_main_radio_single', methods: ['GET'])]
    public function radio_single(string $slug, RadioRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/radio/single.html.twig', [
            'post' => $post,
            'title' => 'Radio',
        ]);
    }
    
}