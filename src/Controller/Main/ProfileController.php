<?php // src/Controller/ProfileController.php

namespace App\Controller\Main;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends MainController
{
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/user';
    }

    #[Route('/user', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render($this->getPageTemplatePrefix() . '/index.html.twig', [
            'posts' => $posts,
            'title' => 'Users',
        ]);
    }

    #[Route('/user/{slug}', name: 'app_user_profile', methods: ['GET'])]
    public function orbiter(string $slug, UserRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render($this->getPageTemplatePrefix() . '/profile.html.twig', [
            'post' => $post,
            'title' => 'Profile',
        ]);
    } 
}