<?php // src/Twig/Components/Icon.php

namespace App\Twig\Components\Crud;

use App\Config\NotificationLevel;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Icon
{
    public NotificationLevel $level;
    public bool $subtle = true;
    public string $dimensions = '36px';
}