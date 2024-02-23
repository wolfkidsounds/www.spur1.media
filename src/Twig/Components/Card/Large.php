<?php // src/Twig/Components/Card/Large.php

namespace App\Twig\Components\Card;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Large
{
    public $post;
    public int $col_size;
    public int $gap_size;
    public string $path_url;
    public string $large_text;
    public string $small_text;
    public string $style = 'thumbnail_grayscale';
}