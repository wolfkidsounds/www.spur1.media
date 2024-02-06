<?php //src/Controller/UiController.php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UiController extends AbstractController
{
    #[Route('/admin/ui', name: 'admin_ui')]
    public function ui(): Response
    {
        return $this->render('admin/ui.html.twig');
    }
}