<?php // src/Twig/Components/Actions.php

namespace App\Twig\Components\Crud;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Actions
{
    public array $actions;
    public string $path_url;
    public string $title;
}