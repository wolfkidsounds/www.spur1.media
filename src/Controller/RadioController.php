<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RadioController extends AbstractController
{
    #[Route('/radio', name: 'app_radio', methods: ['GET'])]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'radio'], ['Date' => 'DESC']);

        return $this->render('_template/grid.html.twig', [
            'posts' => $posts,
            'title' => 'Radio',
        ]);
    }
}
