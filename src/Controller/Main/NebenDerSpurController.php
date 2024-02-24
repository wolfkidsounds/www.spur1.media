<?php // src/Controller/NebenDerSpurController.php

namespace App\Controller\Main;

use App\Controller\Main\MainController;
use App\Repository\NebenDerSpurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NebenDerSpurController extends MainController
{
    #[Route('/neben-der-spur', name: 'app_main_neben-der-spur_index', methods: ['GET'])]
    public function nebenDerSpur_index(NebenDerSpurRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/neben-der-spur/index.html.twig', [
            'posts' => $posts,
            'title' => 'Neben Der Spur',
        ]);
    }

    #[Route('/neben-der-spur/{slug}', name: 'app_main_neben-der-spur_single', methods: ['GET'])]
    public function nebenDerSpur_single(string $slug, NebenDerSpurRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/neben-der-spur/single.html.twig', [
            'post' => $post,
            'title' => 'Neben Der Spur',
        ]);
    }
    
}