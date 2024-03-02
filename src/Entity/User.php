<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\Column(type: 'easy_media_type', nullable: true)]
    private ?string $Image = null;

    #[ORM\Column(length: 255)]
    private ?string $Slug = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'Owner')]
    private Collection $Artists;

    #[ORM\ManyToMany(targetEntity: Crew::class, mappedBy: 'Owner')]
    private Collection $Crews;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Post::class)]
    private Collection $Posts;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Notification::class, orphanRemoval: true)]
    private Collection $Notifications;

    public function __construct()
    {
        $this->Artists = new ArrayCollection();
        $this->Crews = new ArrayCollection();
        $this->Posts = new ArrayCollection();
        $this->Notifications = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): static
    {
        $this->Image = $Image;

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
            $artist->addOwner($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->Artists->removeElement($artist)) {
            $artist->removeOwner($this);
        }

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
            $crew->addOwner($this);
        }

        return $this;
    }

    public function removeCrew(Crew $crew): static
    {
        if ($this->Crews->removeElement($crew)) {
            $crew->removeOwner($this);
        }

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
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->Posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->Notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->Notifications->contains($notification)) {
            $this->Notifications->add($notification);
            $notification->setUser($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->Notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getUser() === $this) {
                $notification->setUser(null);
            }
        }

        return $this;
    }
}
