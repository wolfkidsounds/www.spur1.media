<?php

namespace App\Entity;

use App\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use App\Repository\OrbiterSessionRepository;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

#[ORM\Entity(repositoryClass: OrbiterSessionRepository::class)]
#[ORM\Table(name: 'post')]
class OrbiterSession extends Post
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
