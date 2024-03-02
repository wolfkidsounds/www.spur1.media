<?php // src/Twig/Components/Tite.php

namespace App\Twig\Components\Crud;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Title
{
    public string $title;
}