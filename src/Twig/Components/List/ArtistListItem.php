<?php // src/Twig/Components/List/ArtistList.php

namespace App\Twig\Components\List;

use App\Entity\Artist;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class ArtistListItem
{
    public Artist $artist;
    public string $path_url;
}