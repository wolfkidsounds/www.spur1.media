<?php //src/Entity/Notification.php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Config\NotificationLevel;
use App\Config\NotificationStatus;
use App\Repository\NotificationRepository;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true, enumType: NotificationLevel::class)]
    private ?NotificationLevel $Level = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Text = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true, enumType: NotificationStatus::class)]
    private ?NotificationStatus $Status = NotificationStatus::Unread;

    #[ORM\ManyToOne(inversedBy: 'Notifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
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

    public function getLevel(): ?NotificationLevel
    {
        return $this->Level;
    }

    public function setLevel(NotificationLevel $Level): static
    {
        $this->Level = $Level;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): static
    {
        $this->Text = $Text;

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

    public function getStatus(): ?NotificationStatus
    {
        return $this->Status;
    }

    public function setStatus(NotificationStatus $Status): static
    {
        $this->Status = $Status;

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
}
