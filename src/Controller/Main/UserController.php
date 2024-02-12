<?php // src/Controller/UserController.php

namespace App\Controller\Main;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends MainController
{
    #[Route('/members', name: 'app_main_user_index', methods: ['GET'])]
    public function user_index(UserRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/user/index.html.twig', [
            'posts' => $posts,
            'title' => 'Users',
        ]);
    }

    #[Route('/member/{slug}', name: 'app_main_user_single', methods: ['GET'])]
    public function user_single(string $slug, UserRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/user/single.html.twig', [
            'post' => $post,
            'title' => $post->getName(),
        ]);
    }

    #[Route('/user/artists', name: 'app_main_user_artists', methods: ['GET'])]
    public function user_artists(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $artists = $user->getArtists();

        return $this->render('section/main/page/user/my-artists.html.twig', [
            'user' => $user,
            'artists' => $artists,
            'title' => 'My Artists',
        ]);
    }
}