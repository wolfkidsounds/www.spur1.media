<?php // src/Controller/Crew.php

namespace App\Controller\Artists;

use App\Form\CrewFilterType;
use App\Controller\BaseController;
use App\Repository\CrewRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrewController extends BaseController
{
    #[Route('/crews', name: 'app_crew_index', methods: ['GET', 'POST'])]
    public function crew_index(Request $request, CrewRepository $repository): Response
    {
        $form = $this->createForm(CrewFilterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $posts = $repository->searchArtists(
                $data['search'],
                $data['verified'],
                $data['crew'],
                $data['city'],
            );

            return $this->render('section/artist/page/crew/_preview.html.twig', [
                'path_url' => 'app_crew_single',
                'posts' => $posts,
            ]);
        }

        $posts = $this->getRandomCrews($repository, 10);
        return $this->render('section/artist/page/crew/index.html.twig', [
            'posts' => $posts,
            'form' => $form,
            'title' => 'Crews',
        ]);
    }

    public function getRandomCrews(CrewRepository $repository, int $limit)
    {
        $allIds = $repository->createQueryBuilder('c')
            ->select('c.id')
            ->getQuery()
            ->getResult();
        $allIds = array_column($allIds, 'id');
        shuffle($allIds);
        $randomIds = array_slice($allIds, 0, $limit);

        return $repository->findBy(['id' => $randomIds]);
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

    #[Route('/user/crews/{action}', name: 'app_crew_action', methods: ['GET', 'POST'])]
    public function user_crew_action(string $action = 'add', int $id = null, CrewRepository $crewRepository): Response
    {
        return $this->redirectToRoute('app_crew_index');
    }

    #[Route('/user/crews/{action}/{id}', name: 'app_crew_action_id', methods: ['GET', 'POST'])]
    public function user_crew_action_id(string $action = 'add', int $id = null, CrewRepository $crewRepository): Response
    {
        return $this->redirectToRoute('app_crew_index');
    }
    
}