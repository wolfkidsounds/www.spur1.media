<?php // src/Entity/Crew.php

namespace App\Entity;

use App\Repository\CrewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'Crews')]
    private Collection $Owner;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'Crews')]
    private Collection $Posts;

    #[ORM\Column(nullable: true)]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Gedmo\Timestampable]
    private ?\DateTimeImmutable $editedAt = null;

    #[ORM\OneToMany(mappedBy: 'Crew', targetEntity: Link::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $Links;

    public function __construct()
    {
        $this->Artist = new ArrayCollection();
        $this->Owner = new ArrayCollection();
        $this->Posts = new ArrayCollection();
        $this->Links = new ArrayCollection();
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
            $post->addCrew($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->Posts->removeElement($post)) {
            $post->removeCrew($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeImmutable
    {
        return $this->editedAt;
    }

    public function setEditedAt(?\DateTimeImmutable $editedAt): static
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLinks(): Collection
    {
        return $this->Links;
    }

    public function addLink(Link $link): static
    {
        if (!$this->Links->contains($link)) {
            $this->Links->add($link);
            $link->setCrew($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->Links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getCrew() === $this) {
                $link->setCrew(null);
            }
        }

        return $this;
    }
}
