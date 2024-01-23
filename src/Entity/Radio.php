<?php //src/Entity/Radio.php

namespace App\Entity;

use App\Repository\RadioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RadioRepository::class)]
class Radio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'Radios')]
    private Collection $Artists;

    public function __construct()
    {
        $this->Artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getYouTubeURL(): ?string
    {
        return $this->YouTubeUrl;
    }

    public function setYouTubeURL(?string $YouTubeUrl): static
    {
        $this->YouTubeUrl = $YouTubeUrl;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->Artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->Artists->contains($artist)) {
            $this->Artists->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        $this->Artists->removeElement($artist);

        return $this;
    }
}
