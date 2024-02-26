<?php

namespace App\Entity;

use App\Repository\StateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StateRepository::class)]
class State
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'States')]
    private ?Country $Country = null;

    #[ORM\OneToMany(mappedBy: 'State', targetEntity: City::class)]
    private Collection $Cities;

    #[ORM\Column(length: 255)]
    private ?string $Geonames = null;

    public function __construct()
    {
        $this->Cities = new ArrayCollection();
    }

    public function __toString(): string
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

    public function setName(?string $Name): static
    {
        $this->Name = $Name;

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

    /**
     * @return Collection<int, City>
     */
    public function getCities(): Collection
    {
        return $this->Cities;
    }

    public function addCity(City $city): static
    {
        if (!$this->Cities->contains($city)) {
            $this->Cities->add($city);
            $city->setState($this);
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        if ($this->Cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getState() === $this) {
                $city->setState(null);
            }
        }

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
