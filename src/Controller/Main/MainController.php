<?php // src/Controller/MainController.php

namespace App\Controller\Main;

use App\Controller\BaseController;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends BaseController
{
    #[Route('/', name: 'app_main_index')]
    public function index(Request $request, PostRepository $postRepository): Response
    {
        $searchTerm = $request->query->get('q');
        $posts = $postRepository->search(
            $searchTerm
        );

        return $this->render('section/main/page/index.html.twig', [
            'posts' => $posts,
            'searchTerm' => $searchTerm,
            'title' => 'Home',
        ]);
    }
}