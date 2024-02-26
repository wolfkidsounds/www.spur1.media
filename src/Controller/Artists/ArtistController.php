<?php // src/Controller/Artist.php

namespace App\Controller\Artists;

use App\Form\ArtistFilterType;
use App\Controller\BaseController;
use App\Repository\ArtistRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends BaseController
{
    #[Route('/artists', name: 'app_artist_index', methods: ['GET', 'POST'])]
    public function artist_index(Request $request, ArtistRepository $repository): Response
    {
        $form = $this->createForm(ArtistFilterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $posts = $repository->searchArtists(
                $data['search'],
                $data['verified'],
                $data['artisttype'],
                $data['acttype'],
                $data['gender'],
                $data['crew'],
                $data['city'],
            );

            return $this->render('section/artist/page/artist/_preview.html.twig', [
                'path_url' => 'app_artist_single',
                'posts' => $posts,
            ]);
        }

        $posts = $this->getRandomArtists($repository, 10);
        return $this->render('section/artist/page/artist/index.html.twig', [
            'posts' => $posts,
            'form' => $form,
            'title' => 'Artists',
        ]);
    }

    public function getRandomArtists(ArtistRepository $repository, int $limit)
    {
        $allIds = $repository->createQueryBuilder('a')
            ->select('a.id')
            ->getQuery()
            ->getResult();
        $allIds = array_column($allIds, 'id');
        shuffle($allIds);
        $randomIds = array_slice($allIds, 0, $limit);

        return $repository->findBy(['id' => $randomIds]);
    }

    #[Route('/artist/{slug}', name: 'app_artist_single', methods: ['GET'])]
    public function artist_single(string $slug, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['Slug' => $slug]);
        $posts = $artist->getPosts()->toArray();

        return $this->render('section/artist/page/artist/single.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }

    #[Route('/artist/edit/{id}', name: 'app_artist_edit', methods: ['GET'])]
    public function artist_edit(int $id, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['id' => $id]);
        $posts = $artist->getPosts()->toArray();

        return $this->render('section/artist/page/artist/edit.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }

    #[Route('/artist/claim/{slug}', name: 'app_artist_claim', methods: ['GET'])]
    public function artist_claim(string $slug, ArtistRepository $artistRepository): Response
    {
        $artist = $artistRepository->findOneBy(['slug' => $slug]);
        $posts = $artist->getPosts()->toArray();

        return $this->render('section/artist/page/artist/claim.html.twig', [
            'post' => $artist,
            'title' => 'Artist',
            'related_posts' => $posts,
        ]);
    }
    
}