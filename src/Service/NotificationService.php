<?php // src/Service/NotificationService.php

namespace App\Service;

use App\Entity\User;
use App\Entity\Notification;
use App\Config\NotificationLevel;
use App\Config\NotificationStatus;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService
{   
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createNotification(NotificationLevel $level = NotificationLevel::Info, string $text, NotificationStatus $status = NotificationStatus::Unread, User $user ): void
    {
        $notification = new Notification();
        $notification
            ->setLevel($level)
            ->setText($text)
            ->setStatus($status)
            ->setUser($user);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }
}