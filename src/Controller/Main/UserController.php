<?php // src/Controller/UserController.php

namespace App\Controller\Main;

use App\Entity\User;
use App\Entity\Artist;
use App\Config\ClaimStatus;
use App\Entity\ClaimRequest;
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
    #[Route('/members', name: 'app_members', methods: ['GET'])]
    public function user_index(UserRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/user/index.html.twig', [
            'posts' => $posts,
            'title' => 'Users',
        ]);
    }

    #[Route('/member/{slug}', name: 'app_members_slug', methods: ['GET'])]
    public function user_single(string $slug, UserRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/user/single.html.twig', [
            'post' => $post,
            'title' => $post->getName(),
        ]);
    }

    #[Route('/user/artists/', name: 'app_user_artists', methods: ['GET', 'POST'])]
    public function user_artists(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $posts = $user->getArtists();

        if ( $request->isXmlHttpRequest() )
        {
            $action = $request->request->get('action');

            if($action == 'add') {
                $artist = new Artist();
                $form = $this->createForm(AddArtistFormType::class, $artist, [
                    'action' => $this->generateUrl('app_user_artists_add'),
                    'method' => 'POST',
                ]);

                $template = 'addArtist_modal.html.twig';
            }

            if($action == 'claim') {
                $claimRequest = new ClaimRequest();

                $form = $this->createForm(ClaimArtistFormType::class, $claimRequest, [
                    'action' => $this->generateUrl('app_user_artists_claim'),
                    'method' => 'POST',
                ]);

                $template = 'claimArtist_modal.html.twig';
            }

            return $this->render('section/main/page/user/modal/' . $template, [
                'form' => $form,
            ]);

        }

        return $this->render('section/main/page/user/my-artists.html.twig', [
            'posts' => $posts,
            'title' => 'My Artists',
        ]);
    }

    #[Route('/user/artists/claim', name: 'app_user_artists_claim', methods: ['POST'])]
    public function userArtistsClaimRequest(Request $request, EntityManagerInterface $entityManager)
    {
        /** @var User $user */
        $user = $this->getUser();

        $claimRequest = new ClaimRequest();
        $claimRequest->setUser($user);
        $claimRequest->setStatus(ClaimStatus::Requested);

        dump($claimRequest);

        $form = $this->createForm(ClaimArtistFormType::class, $claimRequest);
        $form->handleRequest($request);

        dump($form);

        if($form->isSubmitted() && $form->isValid()) {
            dump($form);
            $entityManager->persist($claimRequest);
            $entityManager->flush();
            $this->addFlash('success', 'This worked, the request was received successfully.');

            $data = [
                'url' => $this->generateUrl('app_user_artists'),
            ];

            return $this->json($data);

        } else {
            $this->addFlash('error', 'Oh no something went wrong during submission.');

            $data = [
                'url' => $this->generateUrl('app_user_artists'),
            ];

            return $this->json($data);
        }

    }

    #[Route('/user/artists/add', name: 'app_user_artists_add', methods: ['POST'])]
    public function userArtistsAdd(Request $request, EntityManagerInterface $entityManager)
    {
        /** @var User $user */
        $user = $this->getUser();

        $artist = new Artist();
        $artist->addOwner($user);

        $form = $this->createForm(AddArtistFormType::class, $artist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($artist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_artists');
    }

    #[Route('/user/crews', name: 'app_user_crews', methods: ['GET'])]
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

    // NOTIFICATIONS
    #[Route('/user/notifications', name: 'app_user_notifications', methods: ['GET'])]
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

    #[Route('/user/notification/mark-as-read/{id}', name: 'app_user_notification_mark', methods: ['POST'])]
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
            return $this->redirectToRoute('app_user_notifications');
        }

        if ($id === 0) {
            foreach ($notifications as $notification) {
                $notification->setStatus(NotificationStatus::Read);
            }

            $entityManager->persist($notification);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_notifications');
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
                  
            return $this->redirectToRoute('app_user_notifications');
        }

        return $this->redirectToRoute('app_user_notifications');
    }
}