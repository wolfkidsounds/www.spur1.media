<?php // src/Twig/Components/Button/IconLink.php

namespace App\Twig\Components\Button;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class IconLink
{
    public string $icon;
    public string $path_url = '';
    public string $color = 'secondary';
    public string $title;
    public string $size = '';
}
