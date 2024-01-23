<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\ManyToMany(targetEntity: Radio::class, mappedBy: 'Artists')]
    private Collection $Radios;

    public function __construct()
    {
        $this->Radios = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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

    /**
     * @return Collection<int, Radio>
     */
    public function getRadios(): Collection
    {
        return $this->Radios;
    }

    public function addRadio(Radio $radio): static
    {
        if (!$this->Radios->contains($radio)) {
            $this->Radios->add($radio);
            $radio->addArtist($this);
        }

        return $this;
    }

    public function removeRadio(Radio $radio): static
    {
        if ($this->Radios->removeElement($radio)) {
            $radio->removeArtist($this);
        }

        return $this;
    }
}
