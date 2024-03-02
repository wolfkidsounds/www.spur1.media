<?php // src/Twig/Components/Crud.php

namespace App\Twig\Components\Crud;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Crud
{
    public $posts;
    public string $title;
    public string $path_url;
    public string $noItemsText;
    public array $actions;
    public array $table;
}