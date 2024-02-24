<?php // src/Controller/RecSessionController.php

namespace App\Controller\Main;

use App\Controller\Main\MainController;
use App\Repository\RecSessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecSessionController extends MainController
{
    #[Route('/rec-session', name: 'app_main_rec-session_index', methods: ['GET'])]
    public function RecSession_index(RecSessionRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/rec-session/index.html.twig', [
            'posts' => $posts,
            'title' => 'Rec Session',
        ]);
    }

    #[Route('/rec-session/{slug}', name: 'app_main_rec-session_single', methods: ['GET'])]
    public function RecSession_single(string $slug, RecSessionRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/rec-session/single.html.twig', [
            'post' => $post,
            'title' => 'Rec Session',
        ]);
    }
    
}