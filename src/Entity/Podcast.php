<?php

namespace App\Entity;

use App\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PodcastRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

#[ORM\Entity(repositoryClass: PodcastRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'post_type', type: 'string')]
#[DiscriminatorMap(['post' => Post::class, 'podcast' => Podcast::class])]
class Podcast extends Post
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    public function getYouTubeUrl(): ?string
    {
        return $this->YouTubeUrl;
    }

    public function setYouTubeUrl(?string $YouTubeUrl): static
    {
        $this->YouTubeUrl = $YouTubeUrl;

        return $this;
    }
}
