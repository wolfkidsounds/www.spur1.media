<?php // src/Twig/Components/Table.php

namespace App\Twig\Components\Crud;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Table
{
    public array $table;
    public string $path_url;
    public string $title;
    public string $noItemsText;
    public $posts;
}