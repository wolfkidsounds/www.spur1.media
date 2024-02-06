<?php

namespace App\Entity;

use App\Entity\Post;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtistRepository;
use ApiPlatform\Metadata\ApiResource;
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

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'Artists')]
    private Collection $Posts;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'Artists')]
    private Collection $Owner;

    public function __construct()
    {
        $this->Posts = new ArrayCollection();
        $this->Owner = new ArrayCollection();
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

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->Posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->Posts->contains($post)) {
            $this->Posts->add($post);
            $post->addArtist($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->Posts->removeElement($post)) {
            $post->removeArtist($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOwner(): Collection
    {
        return $this->Owner;
    }

    public function addOwner(User $owner): static
    {
        if (!$this->Owner->contains($owner)) {
            $this->Owner->add($owner);
        }

        return $this;
    }

    public function removeOwner(User $owner): static
    {
        $this->Owner->removeElement($owner);

        return $this;
    }
}
