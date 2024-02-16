<?php // src/Twig/Components/Button/Modal.php

namespace App\Twig\Components\Button;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Modal
{
    public string $icon = '';
    public string $image = '';
    public string $color = 'secondary';
    public string $title;
    public string $size = '';
}
