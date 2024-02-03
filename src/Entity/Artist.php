<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[UniqueEntity('Name')]
#[ApiResource()]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Slug = null;

    // Content
    #[ORM\ManyToMany(targetEntity: Radio::class, mappedBy: 'Artists')]
    private Collection $Radios;

    #[ORM\ManyToMany(targetEntity: Windowlicker::class, mappedBy: 'Artists')]
    private Collection $Windowlickers;

    #[ORM\ManyToMany(targetEntity: Teletime::class, mappedBy: 'Artists')]
    private Collection $Teletimes;

    #[ORM\ManyToMany(targetEntity: OrbiterSession::class, mappedBy: 'Artists')]
    private Collection $OrbiterSessions;

    // Social Media
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SoundcloudUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FacebookUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $InstagramUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SpotifyUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MixcloudUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $BandcampUrl = null;

    public function __construct()
    {
        $this->Radios = new ArrayCollection();
        $this->Windowlickers = new ArrayCollection();
        $this->Teletimes = new ArrayCollection();
        $this->OrbiterSessions = new ArrayCollection();
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
            $windowlicker->addArtist($this);
        }

        return $this;
    }

    public function removeWindowlicker(Windowlicker $windowlicker): static
    {
        if ($this->Windowlickers->removeElement($windowlicker)) {
            $windowlicker->removeArtist($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(?string $Slug): static
    {
        $this->Slug = $Slug;

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
            $teletime->addArtist($this);
        }

        return $this;
    }

    public function removeTeletime(Teletime $teletime): static
    {
        if ($this->Teletimes->removeElement($teletime)) {
            $teletime->removeArtist($this);
        }

        return $this;
    }

    public function getYouTubeUrl(): ?string
    {
        return $this->YouTubeUrl;
    }

    public function setYouTubeUrl(?string $YouTubeUrl): static
    {
        $this->YouTubeUrl = $YouTubeUrl;

        return $this;
    }

    public function getSoundcloudUrl(): ?string
    {
        return $this->SoundcloudUrl;
    }

    public function setSoundcloudUrl(?string $SoundcloudUrl): static
    {
        $this->SoundcloudUrl = $SoundcloudUrl;

        return $this;
    }

    public function getFacebookUrl(): ?string
    {
        return $this->FacebookUrl;
    }

    public function setFacebookUrl(?string $FacebookUrl): static
    {
        $this->FacebookUrl = $FacebookUrl;

        return $this;
    }

    public function getInstagramUrl(): ?string
    {
        return $this->InstagramUrl;
    }

    public function setInstagramUrl(?string $InstagramUrl): static
    {
        $this->InstagramUrl = $InstagramUrl;

        return $this;
    }

    /**
     * @return Collection<int, OrbiterSession>
     */
    public function getOrbiterSessions(): Collection
    {
        return $this->OrbiterSessions;
    }

    public function addOrbiterSession(OrbiterSession $orbiterSession): static
    {
        if (!$this->OrbiterSessions->contains($orbiterSession)) {
            $this->OrbiterSessions->add($orbiterSession);
            $orbiterSession->addArtist($this);
        }

        return $this;
    }

    public function removeOrbiterSession(OrbiterSession $orbiterSession): static
    {
        if ($this->OrbiterSessions->removeElement($orbiterSession)) {
            $orbiterSession->removeArtist($this);
        }

        return $this;
    }

    public function getSpotifyUrl(): ?string
    {
        return $this->SpotifyUrl;
    }

    public function setSpotifyUrl(?string $SpotifyUrl): static
    {
        $this->SpotifyUrl = $SpotifyUrl;

        return $this;
    }

    public function getMixcloudUrl(): ?string
    {
        return $this->MixcloudUrl;
    }

    public function setMixcloudUrl(?string $MixcloudUrl): static
    {
        $this->MixcloudUrl = $MixcloudUrl;

        return $this;
    }

    public function getBandcampUrl(): ?string
    {
        return $this->BandcampUrl;
    }

    public function setBandcampUrl(?string $BandcampUrl): static
    {
        $this->BandcampUrl = $BandcampUrl;

        return $this;
    }
}
