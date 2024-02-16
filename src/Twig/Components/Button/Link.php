<?php // src/Twig/Components/Button/Link.php

namespace App\Twig\Components\Button;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Link
{
    public string $image = '';
    public string $icon = '';
    public string $path_url = '';
    public string $color = 'secondary';
    public string $title;
    public string $size = '';
    public bool $new_window = false;
    public string $type = 'outline';
}
