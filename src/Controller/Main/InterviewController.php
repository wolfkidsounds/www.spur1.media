<?php // src/Controller/InterviewController.php

namespace App\Controller\Main;

use App\Controller\Main\MainController;
use App\Repository\InterviewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterviewController extends MainController
{
    #[Route('/interview', name: 'app_main_interview_index', methods: ['GET'])]
    public function Interview_index(InterviewRepository $repository): Response
    {
        $posts = $repository->findBy([], ['Date' => 'DESC']);

        return $this->render('section/main/page/interview/index.html.twig', [
            'posts' => $posts,
            'title' => 'Interview',
        ]);
    }

    #[Route('/interview/{slug}', name: 'app_main_interview_single', methods: ['GET'])]
    public function Interview_single(string $slug, InterviewRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render('section/main/page/interview/single.html.twig', [
            'post' => $post,
            'title' => 'Interview',
        ]);
    }
    
}