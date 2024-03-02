<?php // src/Twig/Components/SinglePost.php

namespace App\Twig\Components\Crud;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class SinglePost
{
    public $post;
    public string $path_url;
}