<?php

namespace App\Entity;

use App\Repository\LinkTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkTypeRepository::class)]
class LinkType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Icon = null;

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

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->Icon;
    }

    public function setIcon(string $Icon): static
    {
        $this->Icon = $Icon;

        return $this;
    }
}
