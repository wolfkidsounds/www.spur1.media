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
        return $this->render('section/crew/page/crew/index.html.twig', [
            'title' => 'Crew',
        ]);
    }

    #[Route('/crew/{slug}', name: 'app_crew_single', methods: ['GET'])]
    public function crew_single(string $slug, CrewRepository $crewRepository): Response
    {
        $crew = $crewRepository->findOneBy(['Slug' => $slug]);
        $posts = $crew->getPosts()->toArray();

        return $this->render('section/crew/page/crew/single.html.twig', [
            'post' => $crew,
            'title' => 'Crew',
            'related_posts' => $posts,
        ]);
    }
    
}