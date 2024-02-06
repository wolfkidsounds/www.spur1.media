<?php //src/Entity/Post.php

namespace App\Entity;

use App\Entity\Tag;
use App\Entity\Artist;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[MappedSuperclass]
#[UniqueEntity('Slug')]
#[ORM\Table(name: 'post')]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'post_type', type: 'string')]
#[DiscriminatorMap([
    'post' => Post::class, 
    'orbiter_session' => OrbiterSession::class,
    'radio' => Radio::class,
    'teletime' => Teletime::class,
    'windowlicker' => Windowlicker::class
])]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $Title = null;

    #[ORM\Column(length: 255)]
    protected ?string $Slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $Image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTimeInterface $Date = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'Posts')]
    protected Collection $Tags;

    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'Posts')]
    private Collection $Artists;

    public function __construct()
    {
        $this->Tags = new ArrayCollection();
        $this->Artists = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->Tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->Tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->Artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->Artists->contains($artist)) {
            $this->Artists->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        $this->Artists->removeElement($artist);

        return $this;
    }
}