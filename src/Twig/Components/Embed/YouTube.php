<?php // src/Twig/Components/Embed/YouTube.php

namespace App\Twig\Components\Embed;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class YouTube
{
    public string $youtube_url = '';
}