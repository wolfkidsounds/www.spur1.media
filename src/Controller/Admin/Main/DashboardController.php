<?php

namespace App\Controller\Admin\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'admin', host: 'admin.%app.host%')]
    public function index(): Response
    {
        return $this->render('admin/dashboard_main.html.twig');
    }
}
