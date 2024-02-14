<?php // src/Twig/Components/Badge/IconLink.php

namespace App\Twig\Components\Badge;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class IconLink
{
    public string $path_url = '';
    public string $icon;
    public string $color = 'dark';
    public string $title;
}
