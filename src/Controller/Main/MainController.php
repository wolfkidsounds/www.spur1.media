<?php // src/Controller/MainController.php

namespace App\Controller\Main;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', host: '%app.host%')]
class MainController extends BaseController
{
    public function getTemplatePrefix(): string
    {
        return 'Main';
    }

    #[Route('/admin')]
    public function redirectToAdmin(): Response
    {
        return $this->redirectToRoute('admin');
    }

    #[Route('/backstage')]
    public function redirectToBackstage()
    {
        $this->redirectToRoute('app_backstage_index');
    }

    #[Route('/archive')]
    public function redirectToArchive()
    {
        $this->redirectToRoute('app_archive_index');
    }

    #[Route('/artists')]
    public function redirectToArtists()
    {
        $this->redirectToRoute('app_artists_index');
    }
    
}