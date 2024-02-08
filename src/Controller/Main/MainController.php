<?php // src/Controller/MainController.php

namespace App\Controller\Main;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends BaseController
{
    #[Route('/', name: 'app_main_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('section/main/page/index.html.twig', [
            'title' => 'News',
        ]);
    }
}