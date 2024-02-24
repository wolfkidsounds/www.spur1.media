<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: 'easy_media_type', nullable: true)]
    private $Image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\OneToMany(mappedBy: 'Club', targetEntity: Link::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $Links;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MapsUrl = null;

    public function __construct()
    {
        $this->Links = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLinks(): Collection
    {
        return $this->Links;
    }

    public function addLink(Link $link): static
    {
        if (!$this->Links->contains($link)) {
            $this->Links->add($link);
            $link->setClub($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->Links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getClub() === $this) {
                $link->setClub(null);
            }
        }

        return $this;
    }

    public function getMapsUrl(): ?string
    {
        return $this->MapsUrl;
    }

    public function setMapsUrl(?string $MapsUrl): static
    {
        $this->MapsUrl = $MapsUrl;

        return $this;
    }
}
