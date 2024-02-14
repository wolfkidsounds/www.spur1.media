<?php // src/Twig/Components/Embed/Mixcloud.php

namespace App\Twig\Components\Embed;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Mixcloud
{
    public string $mixcloud_url = '';
}