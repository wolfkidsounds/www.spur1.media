<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'Cities')]
    private ?State $State = null;

    #[ORM\ManyToOne(inversedBy: 'Cities')]
    private ?Country $Country = null;

    #[ORM\Column(length: 255)]
    private ?string $Geonames = null;

    public function __toString(): string
    {
        return $this->Name . ' (' . $this->State . ')';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->State;
    }

    public function setState(?State $State): static
    {
        $this->State = $State;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->Country;
    }

    public function setCountry(?Country $Country): static
    {
        $this->Country = $Country;

        return $this;
    }

    public function getGeonames(): ?string
    {
        return $this->Geonames;
    }

    public function setGeonames(string $Geonames): static
    {
        $this->Geonames = $Geonames;

        return $this;
    }
}
