<?php // src/Controller/UserController.php

namespace App\Controller\Main;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends MainController
{
    #[Route('/user', name: 'app_main_user_index', methods: ['GET'])]
    public function user_index(UserRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/user/index.html.twig', [
            'posts' => $posts,
            'title' => 'User',
        ]);
    }

    #[Route('/user/{slug}', name: 'app_main_user_single', methods: ['GET'])]
    public function user_single(string $slug, UserRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/user/single.html.twig', [
            'post' => $post,
            'title' => 'User',
        ]);
    } 
}