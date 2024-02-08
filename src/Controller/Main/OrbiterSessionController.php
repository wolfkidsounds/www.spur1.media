<?php // src/Controller/OrbiterSessionController.php

namespace App\Controller\Main;

use App\Controller\Main\MainController;
use App\Repository\OrbiterSessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrbiterSessionController extends MainController
{
    #[Route('/orbiter-session', name: 'app_main_orbiter-session_index', methods: ['GET'])]
    public function orbiterSession_index(OrbiterSessionRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/orbiter-session/index.html.twig', [
            'posts' => $posts,
            'title' => 'Orbiter Session',
        ]);
    }

    #[Route('/orbiter-session/{slug}', name: 'app_main_orbiter-session_single', methods: ['GET'])]
    public function orbiterSession_single(string $slug, OrbiterSessionRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/orbiter-session/single.html.twig', [
            'post' => $post,
            'title' => 'Orbiter Session',
        ]);
    }
    
}