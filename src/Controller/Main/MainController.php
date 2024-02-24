<?php // src/Controller/MainController.php

namespace App\Controller\Main;

use App\Controller\BaseController;
use App\Repository\ArtistRepository;
use App\Repository\CrewRepository;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends BaseController
{
    #[Route('/', name: 'app_main_index')]
    public function index(ArtistRepository $artistRepository, CrewRepository $crewRepository, PostRepository $postRepository): Response
    {
        $artists = $artistRepository->findBy([], ['createdAt' => 'DESC'], 6);
        $crews = $crewRepository->findBy([], ['createdAt' => 'DESC'], 6);
        $posts = $postRepository->findBy([], ['createdAt' => 'DESC'], 6);

        return $this->render('section/main/page/index.html.twig', [
            'artists' => $artists,
            'crews' => $crews,
            'posts' => $posts,
            'title' => 'Home',
        ]);
    }
}