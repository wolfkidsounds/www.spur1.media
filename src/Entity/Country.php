<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'Country', targetEntity: State::class)]
    private Collection $States;

    #[ORM\OneToMany(mappedBy: 'Country', targetEntity: City::class)]
    private Collection $Cities;

    #[ORM\Column(length: 255)]
    private ?string $Code = null;

    public function __construct()
    {
        $this->States = new ArrayCollection();
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

    /**
     * @return Collection<int, State>
     */
    public function getStates(): Collection
    {
        return $this->States;
    }

    public function addState(State $state): static
    {
        if (!$this->States->contains($state)) {
            $this->States->add($state);
            $state->setCountry($this);
        }

        return $this;
    }

    public function removeState(State $state): static
    {
        if ($this->States->removeElement($state)) {
            // set the owning side to null (unless already changed)
            if ($state->getCountry() === $this) {
                $state->setCountry(null);
            }
        }

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
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        if ($this->Cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): static
    {
        $this->Code = $Code;

        return $this;
    }
}
