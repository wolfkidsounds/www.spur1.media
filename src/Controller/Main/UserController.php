<?php // src/Controller/UserController.php

namespace App\Controller\Main;

use App\Entity\User;
use App\Entity\Artist;
use App\Form\AddArtistFormType;
use App\Form\ClaimArtistFormType;
use App\Config\NotificationStatus;
use App\Repository\UserRepository;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NotificationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

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
    public function user_artists(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $posts = $user->getArtists();

        $artist = new Artist();
        $artist->addOwner($user);

        $addForm = $this->createForm(AddArtistFormType::class, $artist);
        $addForm->handleRequest($request);

        $claimForm = $this->createForm(ClaimArtistFormType::class);
        $claimForm->handleRequest($request);

        if($addForm->isSubmitted() && $addForm->isValid()) {
            $entityManager->persist($artist);
            $entityManager->flush();
        }

        if($claimForm->isSubmitted() && $claimForm->isValid()) {
            $entityManager->persist($artist);
            $entityManager->flush();
        }

        return $this->render('section/main/page/user/my-artists.html.twig', [
            'addForm' => $addForm,
            'claimForm' => $claimForm,
            'user' => $user,
            'posts' => $posts,
            'title' => 'My Artists',
        ]);
    }

    #[Route('/user/artists/{action}', name: 'app_artist_action', methods: ['GET'])]
    public function user_artist_action(string $action, ArtistRepository $artistRepository): Response
    {
        return $this->redirectToRoute('app_artist_index');
    }

    #[Route('/user/artists/{action}/{id}', name: 'app_artist_action_id', methods: ['GET', 'POST'])]
    public function user_artist_action_id(string $action = 'add', int $id = null, ArtistRepository $artistRepository): Response
    {
        if($action === 'view' && $id !== null) {
            $artist = $artistRepository->findOneBy(['id' => $id]);
            return $this->redirectToRoute('app_artist_single', ['slug' => $artist->getSlug()]);
        }
        
        return $this->redirectToRoute('app_artist_index');
    }

    #[Route('/user/crews', name: 'app_main_user_crews', methods: ['GET'])]
    public function user_crews(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $posts = $user->getCrews();

        return $this->render('section/main/page/user/my-crews.html.twig', [
            'user' => $user,
            'posts' => $posts,
            'title' => 'My Crews',
        ]);
    }

    #[Route('/user/notification', name: 'app_main_user_notification', methods: ['GET'])]
    public function user_notifications(NotificationRepository $notificationRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $notifications = $notificationRepository->findBy(['User' => $user], ['createdAt' => 'DESC']);

        return $this->render('section/main/page/user/notifications.html.twig', [
            'user' => $user,
            'posts' => $notifications,
            'title' => 'Notifications',
        ]);
    }

    #[Route('/user/notification/mark-as-read/{id}', name: 'app_main_user_notification_mark', methods: ['POST'])]
    public function user_notifications_mark(Request $request, CsrfTokenManagerInterface $csrfTokenManager, int $id = null, EntityManagerInterface $entityManager): Response
    {
        $csrfToken = $request->headers->get('X-CSRF-Token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('mark-as-read', $csrfToken))) {
            dump($csrfToken);
            // Handle invalid CSRF token, maybe return an error response
            return new Response('Invalid CSRF token', Response::HTTP_FORBIDDEN);
        }

        /** @var User $user */
        $user = $this->getUser();
        $notifications = $user->getNotifications();

        if($id === null)
        {
            return $this->redirectToRoute('app_main_user_notification');
        }

        if ($id === 0) {
            foreach ($notifications as $notification) {
                $notification->setStatus(NotificationStatus::Read);
            }

            $entityManager->persist($notification);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_user_notification');
        }

        if($id !== 0 && $id !== null) 
        {
            $notification = null;
            foreach ($notifications as $n) {
                if ($n->getId() === $id) {
                    $notification = $n;
                    break;
                }
            }

            if ($notification !== null) {
                $notification->setStatus(NotificationStatus::Read);
                $entityManager->persist($notification);
                $entityManager->flush();
            }
                  
            return $this->redirectToRoute('app_main_user_notification');
        }

        return $this->redirectToRoute('app_main_user_notification');
    }
}