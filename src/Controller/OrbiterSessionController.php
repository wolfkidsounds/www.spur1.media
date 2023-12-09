<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrbiterSessionController extends AbstractController
{
    #[Route('/orbiter-session', name: 'app_orbitersession', methods: ['GET'])]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'orbitersession'], ['Date' => 'DESC']);

        return $this->render('_template/grid.html.twig', [
            'posts' => $posts,
            'title' => 'Orbiter Session',
        ]);
    }
}
