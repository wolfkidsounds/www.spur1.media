<?php

namespace App\Entity;

use App\Entity\Post;
use App\Repository\ArtistRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('Name')]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: 'easy_media_type', nullable: true)]
    private ?string $Image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Slug = null;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'Artists')]
    private Collection $Posts;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'Artists')]
    private Collection $Owner;

    #[ORM\ManyToMany(targetEntity: Crew::class, mappedBy: 'Artist')]
    private Collection $Crews;

    #[ORM\OneToMany(mappedBy: 'Artist', targetEntity: Link::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $Links;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $editedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isVerified = false;

    #[ORM\ManyToMany(targetEntity: Gender::class)]
    private Collection $Gender;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Tourbox = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ArtistType $ArtistType = null;

    #[ORM\ManyToMany(targetEntity: ActType::class)]
    private Collection $ActType;

    #[ORM\ManyToOne]
    private ?City $City = null;

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps(): void
    {
        $dateTimeNow = new DateTimeImmutable('now');

        $this->setEditedAt($dateTimeNow);

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function __construct()
    {
        $this->Posts = new ArrayCollection();
        $this->Owner = new ArrayCollection();
        $this->Crews = new ArrayCollection();
        $this->Links = new ArrayCollection();
        $this->Gender = new ArrayCollection();
        $this->ActType = new ArrayCollection();
    }

    public function __toString(): string
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

    /**
     * @return Collection<int, Crew>
     */
    public function getCrews(): Collection
    {
        return $this->Crews;
    }

    public function addCrew(Crew $crew): static
    {
        if (!$this->Crews->contains($crew)) {
            $this->Crews->add($crew);
            $crew->addArtist($this);
        }

        return $this;
    }

    public function removeCrew(Crew $crew): static
    {
        if ($this->Crews->removeElement($crew)) {
            $crew->removeArtist($this);
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
            $link->setArtist($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->Links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getArtist() === $this) {
                $link->setArtist(null);
            }
        }

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(?bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Gender>
     */
    public function getGender(): Collection
    {
        return $this->Gender;
    }

    public function addGender(Gender $gender): static
    {
        if (!$this->Gender->contains($gender)) {
            $this->Gender->add($gender);
        }

        return $this;
    }

    public function removeGender(Gender $gender): static
    {
        $this->Gender->removeElement($gender);

        return $this;
    }

    public function getTourbox(): ?string
    {
        return $this->Tourbox;
    }

    public function setTourbox(?string $Tourbox): static
    {
        $this->Tourbox = $Tourbox;

        return $this;
    }

    public function getArtistType(): ?ArtistType
    {
        return $this->ArtistType;
    }

    public function setArtistType(?ArtistType $ArtistType): static
    {
        $this->ArtistType = $ArtistType;

        return $this;
    }

    /**
     * @return Collection<int, ActType>
     */
    public function getActType(): Collection
    {
        return $this->ActType;
    }

    public function addActType(ActType $actType): static
    {
        if (!$this->ActType->contains($actType)) {
            $this->ActType->add($actType);
        }

        return $this;
    }

    public function removeActType(ActType $actType): static
    {
        $this->ActType->removeElement($actType);

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->City;
    }

    public function setCity(?City $City): static
    {
        $this->City = $City;

        return $this;
    }
}
