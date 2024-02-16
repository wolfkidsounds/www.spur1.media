<?php // src/Controller/SearchController.php

namespace App\Controller\Main;

use App\Controller\BaseController;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends BaseController
{
    #[Route('/search', name: 'app_main_search')]
    public function search(Request $request, PostRepository $postRepository): Response
    {
        $searchTerm = $request->query->get('q');
        $posts = $postRepository->search(
            $searchTerm
        );

        if($request->query->get('preview')) {
            return $this->render('section/main/page/search/_preview.html.twig', [
                'posts' => $posts,
                'searchTerm' => $searchTerm,
                'title' => 'Home',
            ]);
        }

        return $this->render('section/main/page/search/index.html.twig', [
            'posts' => $posts,
            'searchTerm' => $searchTerm,
            'title' => 'Home',
        ]);
    }
}