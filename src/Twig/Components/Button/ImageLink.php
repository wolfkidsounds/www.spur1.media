<?php // src/Twig/Components/Button/ImageLink.php

namespace App\Twig\Components\Button;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class ImageLink
{
    public string $image;
    public string $path_url = '';
    public string $slug;
    public string $color = 'secondary';
    public string $title;
}
