<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Config\ClaimStatus;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClaimRequestRepository;

#[ORM\Entity(repositoryClass: ClaimRequestRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ClaimRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $Artist = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Info = null;

    #[ORM\Column(nullable: true, enumType: ClaimStatus::class)]
    private ?ClaimStatus $Status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Reason = 'No Reason was provided.';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Mail = null;

    #[ORM\PrePersist]
    public function updatedTimestamps(): void
    {
        $dateTimeNow = new DateTimeImmutable('now');

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?Artist
    {
        return $this->Artist;
    }

    public function setArtist(?Artist $Artist): static
    {
        $this->Artist = $Artist;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->Info;
    }

    public function setInfo(?string $Info): static
    {
        $this->Info = $Info;

        return $this;
    }

    public function getStatus(): ?ClaimStatus
    {
        return $this->Status;
    }

    public function setStatus(ClaimStatus $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->Reason;
    }

    public function setReason(?string $Reason): static
    {
        $this->Reason = $Reason;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(?string $Mail): static
    {
        $this->Mail = $Mail;

        return $this;
    }
}
