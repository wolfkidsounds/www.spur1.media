<?php // src/Twig/Components/Card/Image.php

namespace App\Twig\Components\Card;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Image
{
    public string $image;
    public string $corner_style = '';
    public string $style = 'thumbnail';
    public string $width = '';
}
