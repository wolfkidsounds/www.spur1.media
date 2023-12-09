<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WindowlickerController extends AbstractController
{
    #[Route('/windowlicker', name: 'app_windowlicker', methods: ['GET'])]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'windowlicker'], ['Date' => 'DESC']);

        return $this->render('_template/grid.html.twig', [
            'posts' => $posts,
            'title' => 'Windowlicker',
        ]);
    }
}
