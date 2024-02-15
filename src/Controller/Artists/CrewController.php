<?php // src/Controller/Crew.php

namespace App\Controller\Artists;

use App\Controller\BaseController;
use App\Repository\CrewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrewController extends BaseController
{
    #[Route('/crew', name: 'app_crew_index', methods: ['GET'])]
    public function crew_index(): Response
    {
        return $this->render('section/artist/page/crew/index.html.twig', [
            'title' => 'Crew',
        ]);
    }

    #[Route('/crew/{slug}', name: 'app_crew_single', methods: ['GET'])]
    public function crew_single(string $slug, CrewRepository $crewRepository): Response
    {
        $crew = $crewRepository->findOneBy(['Slug' => $slug]);
        $posts = $crew->getPosts()->toArray();

        return $this->render('section/artist/page/crew/single.html.twig', [
            'post' => $crew,
            'title' => 'Crew',
            'related_posts' => $posts,
        ]);
    }

    #[Route('/crew/edit/{id}', name: 'app_crew_edit', methods: ['GET'])]
    public function crew_edit(int $id, CrewRepository $crewRepository): Response
    {
        $crew = $crewRepository->findOneBy(['id' => $id]);
        $posts = $crew->getPosts()->toArray();

        return $this->render('section/artist/page/crew/edit.html.twig', [
            'post' => $crew,
            'title' => 'Crew',
            'related_posts' => $posts,
        ]);
    }

    #[Route('/crew/claim/{slug}', name: 'app_crew_claim', methods: ['GET'])]
    public function crew_claim(string $slug, CrewRepository $crewRepository): Response
    {
        $crew = $crewRepository->findOneBy(['slug' => $slug]);
        $posts = $crew->getPosts()->toArray();

        return $this->render('section/artist/page/crew/claim.html.twig', [
            'post' => $crew,
            'title' => 'Crew',
            'related_posts' => $posts,
        ]);
    }
    
}