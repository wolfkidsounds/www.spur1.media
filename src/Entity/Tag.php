<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Slug = null;

    #[ORM\ManyToOne(inversedBy: 'Tags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TagFormat $Format = null;

    #[ORM\ManyToMany(targetEntity: Radio::class, mappedBy: 'Tags')]
    private Collection $Radios;

    #[ORM\ManyToMany(targetEntity: Windowlicker::class, mappedBy: 'Tags')]
    private Collection $Windowlickers;

    #[ORM\ManyToMany(targetEntity: Teletime::class, mappedBy: 'Tags')]
    private Collection $Teletimes;

    public function __construct()
    {
        $this->Radios = new ArrayCollection();
        $this->Windowlickers = new ArrayCollection();
        $this->Teletimes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Name . ' (' . $this->Format . ')';
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

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): static
    {
        $this->Slug = $Slug;

        return $this;
    }

    public function getFormat(): ?TagFormat
    {
        return $this->Format;
    }

    public function setFormat(?TagFormat $Format): static
    {
        $this->Format = $Format;

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
            $radio->addTag($this);
        }

        return $this;
    }

    public function removeRadio(Radio $radio): static
    {
        if ($this->Radios->removeElement($radio)) {
            $radio->removeTag($this);
        }

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
            $windowlicker->addTag($this);
        }

        return $this;
    }

    public function removeWindowlicker(Windowlicker $windowlicker): static
    {
        if ($this->Windowlickers->removeElement($windowlicker)) {
            $windowlicker->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Teletime>
     */
    public function getTeletimes(): Collection
    {
        return $this->Teletimes;
    }

    public function addTeletime(Teletime $teletime): static
    {
        if (!$this->Teletimes->contains($teletime)) {
            $this->Teletimes->add($teletime);
            $teletime->addTag($this);
        }

        return $this;
    }

    public function removeTeletime(Teletime $teletime): static
    {
        if ($this->Teletimes->removeElement($teletime)) {
            $teletime->removeTag($this);
        }

        return $this;
    }
}
