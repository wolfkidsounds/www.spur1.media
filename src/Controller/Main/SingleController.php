<?php

namespace App\Controller\Main;

use App\Repository\RadioRepository;
use App\Controller\Main\MainController;
use App\Repository\OrbiterSessionRepository;
use App\Repository\TeletimeRepository;
use App\Repository\WindowlickerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleController extends MainController
{   
    public function getPageTemplatePrefix(): string
    {
        return $this->getTemplatePrefix() . '/page/single';
    }

    #[Route('/radio/{slug}', name: 'app_main_radio_single', methods: ['GET'])]
    public function radio(string $slug, RadioRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render($this->getPageTemplatePrefix() . '/radio.html.twig', [
            'post' => $post,
            'title' => 'Radio',
        ]);
    }

    #[Route('/windowlicker/{slug}', name: 'app_main_windowlicker_single', methods: ['GET'])]
    public function windowlicker(string $slug, WindowlickerRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render($this->getPageTemplatePrefix() . '/windowlicker.html.twig', [
            'post' => $post,
            'title' => 'Windowlicker',
        ]);
    }

    #[Route('/teletime/{slug}', name: 'app_main_teletime_single', methods: ['GET'])]
    public function teletime(string $slug, TeletimeRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render($this->getPageTemplatePrefix() . '/teletime.html.twig', [
            'post' => $post,
            'title' => 'Teletime',
        ]);
    }

    #[Route('/orbiter-session/{slug}', name: 'app_main_orbiter_single', methods: ['GET'])]
    public function orbiter(string $slug, OrbiterSessionRepository $repository): Response
    {
        $post = $repository->findOneBy(['Slug' => $slug]);

        return $this->render($this->getPageTemplatePrefix() . '/orbiter_session.html.twig', [
            'post' => $post,
            'title' => 'Orbiter Session',
        ]);
    }
}
