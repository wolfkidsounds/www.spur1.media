<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index(PostRepository $repository): Response
    {
        $orbitersession = $repository->findBy(['Type' => 'orbitersession'], ['Date' => 'DESC']);
        $radio = $repository->findBy(['Type' => 'radio'], ['Date' => 'DESC']);
        $podcast = $repository->findBy(['Type' => 'podcast'], ['Date' => 'DESC']);
        $windowlicker = $repository->findBy(['Type' => 'windowlicker'], ['Date' => 'DESC']);
        $records = $repository->findBy(['Type' => 'records'], ['Date' => 'DESC']);

        return $this->render('page/index.html.twig', [
            'orbitersession' => $orbitersession,
            'radio' => $radio,
            'podcast' => $podcast,
            'windowlicker' => $windowlicker,
            'records' => $records,
            'title' => 'News',
        ]);
    }
}
