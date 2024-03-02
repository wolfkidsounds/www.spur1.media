<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Config\VerificationStatus;
use App\Repository\VerificationRequestRepository;

#[ORM\Entity(repositoryClass: VerificationRequestRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VerificationRequest
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

    #[ORM\Column(nullable: true, enumType: VerificationStatus::class)]
    private ?VerificationStatus $Status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Reason = 'No Reason was provided.';

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

    public function getStatus(): ?VerificationStatus
    {
        return $this->Status;
    }

    public function setStatus(VerificationStatus $Status): static
    {
        $this->Status = $Status;

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

    public function getReason(): ?string
    {
        return $this->Reason;
    }

    public function setReason(string $Reason): static
    {
        $this->Reason = $Reason;

        return $this;
    }
}
