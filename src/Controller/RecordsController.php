<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecordsController extends AbstractController
{
    #[Route('/records', name: 'app_records', methods: ['GET'])]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findBy(['Type' => 'records'], ['Date' => 'DESC']);

        return $this->render('_template/grid.html.twig', [
            'posts' => $posts,
            'title' => 'Records',
        ]);
    }
}
