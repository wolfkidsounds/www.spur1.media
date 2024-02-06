<?php // src/Entity/Crew.php

namespace App\Entity;

use App\Repository\CrewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrewRepository::class)]
class Crew
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'Crews')]
    private Collection $Artist;

    #[ORM\Column(type: 'easy_media_type', nullable: true)]
    private $Image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $Slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SoundcloudUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FacebookUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $InstagramUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LinktreeUrl = null;

    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'Crews')]
    private Collection $Posts;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'Crews')]
    private Collection $Owner;

    public function __construct()
    {
        $this->Artist = new ArrayCollection();
        $this->Posts = new ArrayCollection();
        $this->Owner = new ArrayCollection();
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

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtist(): Collection
    {
        return $this->Artist;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->Artist->contains($artist)) {
            $this->Artist->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        $this->Artist->removeElement($artist);

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

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(?string $Slug): static
    {
        $this->Slug = $Slug;

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

    public function getLinktreeUrl(): ?string
    {
        return $this->LinktreeUrl;
    }

    public function setLinktreeUrl(?string $LinktreeUrl): static
    {
        $this->LinktreeUrl = $LinktreeUrl;

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
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        $this->Posts->removeElement($post);

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
