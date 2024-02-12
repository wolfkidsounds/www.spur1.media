<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Url = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?LinkType $Type = null;

    #[ORM\ManyToOne(inversedBy: 'Links')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Artist $Artist = null;

    #[ORM\ManyToOne(inversedBy: 'Links')]
    private ?Crew $Crew = null;

    #[ORM\ManyToOne(inversedBy: 'Links')]
    private ?Post $Post = null;

    public function __toString(): string
    {
        return $this->Type->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(string $Url): static
    {
        $this->Url = $Url;

        return $this;
    }

    public function getType(): ?LinkType
    {
        return $this->Type;
    }

    public function setType(?LinkType $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->Artist;
    }

    public function setArtist(?Artist $Artist): static
    {
        $this->Artist = $Artist;

        return $this;
    }

    public function getCrew(): ?Crew
    {
        return $this->Crew;
    }

    public function setCrew(?Crew $Crew): static
    {
        $this->Crew = $Crew;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): static
    {
        $this->Post = $Post;

        return $this;
    }
}
