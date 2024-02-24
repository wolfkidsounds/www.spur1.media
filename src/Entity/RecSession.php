<?php

namespace App\Entity;

use App\Repository\RecSessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecSessionRepository::class)]
#[ORM\Table(name: 'post')]
class RecSession extends Post
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    #[ORM\ManyToOne]
    private ?Club $Club = null;

    public function getYouTubeUrl(): ?string
    {
        return $this->YouTubeUrl;
    }

    public function setYouTubeUrl(?string $YouTubeUrl): static
    {
        $this->YouTubeUrl = $YouTubeUrl;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->Club;
    }

    public function setClub(?Club $Club): static
    {
        $this->Club = $Club;

        return $this;
    }
}
