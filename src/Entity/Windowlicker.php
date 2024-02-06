<?php

namespace App\Entity;

use App\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use App\Repository\WindowlickerRepository;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

#[ORM\Entity(repositoryClass: WindowlickerRepository::class)]
#[ORM\Table(name: 'post')]
class Windowlicker extends Post
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    #[ORM\ManyToOne(inversedBy: 'Windowlickers')]
    private ?Location $Location = null;

    public function getYouTubeUrl(): ?string
    {
        return $this->YouTubeUrl;
    }

    public function setYouTubeUrl(?string $YouTubeUrl): static
    {
        $this->YouTubeUrl = $YouTubeUrl;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->Location;
    }

    public function setLocation(?Location $Location): static
    {
        $this->Location = $Location;

        return $this;
    }
}
