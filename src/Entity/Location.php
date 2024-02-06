<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MapsUrl = null;

    // Content
    #[ORM\OneToMany(mappedBy: 'Location', targetEntity: Windowlicker::class)]
    private Collection $Windowlickers;

    public function __construct()
    {
        $this->Windowlickers = new ArrayCollection();
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

    public function getMapsUrl(): ?string
    {
        return $this->MapsUrl;
    }

    public function setMapsUrl(?string $MapsUrl): static
    {
        $this->MapsUrl = $MapsUrl;

        return $this;
    }

    /**
     * @return Collection<int, Windowlicker>
     */
    public function getWindowlickers(): Collection
    {
        return $this->Windowlickers;
    }

    public function addWindowlicker(Windowlicker $windowlicker): static
    {
        if (!$this->Windowlickers->contains($windowlicker)) {
            $this->Windowlickers->add($windowlicker);
            $windowlicker->setLocation($this);
        }

        return $this;
    }

    public function removeWindowlicker(Windowlicker $windowlicker): static
    {
        if ($this->Windowlickers->removeElement($windowlicker)) {
            // set the owning side to null (unless already changed)
            if ($windowlicker->getLocation() === $this) {
                $windowlicker->setLocation(null);
            }
        }

        return $this;
    }
}
