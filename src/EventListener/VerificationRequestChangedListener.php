<?php // src/EventListener/VerificationRequestChangedListener.php
namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Config\ClaimStatus;
use App\Config\NotificationLevel;
use App\Config\NotificationStatus;
use App\Config\VerificationStatus;
use App\Entity\ClaimRequest;
use App\Entity\VerificationRequest;
use App\Service\NotificationService;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::postPersist,  method: 'postPersist',  entity: VerificationRequest::class)]
#[AsEntityListener(event: Events::postUpdate,   method: 'postUpdate',   entity: VerificationRequest::class)]
class VerificationRequestChangedListener
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function postPersist(VerificationRequest $verificationRequest, PostPersistEventArgs $event): void
    {
        $this->createNotification($verificationRequest);
    }

    public function postUpdate(VerificationRequest $verificationRequest, PostUpdateEventArgs $event): void
    {
        $this->createNotification($verificationRequest);
    }

    public function createNotification(VerificationRequest $verificationRequest): void
    {
    
        if( $verificationRequest->getStatus() == VerificationStatus::Requested ) {
            $level = NotificationLevel::Info;
            $text = '<div>Your Request to Verify <strong>' . $verificationRequest->getArtist()->getName() . '</strong> has been received.</div>';
        }
    
        if( $verificationRequest->getStatus() == VerificationStatus::Denied ) {
            $level = NotificationLevel::Error;
            $text = '<div>Your Request to Verify <strong>' . $verificationRequest->getArtist()->getName() . '</strong> has been rejected.</div>';
            $text .= '<br>';
            $text .= $verificationRequest->getReason();
        }
    
        if( $verificationRequest->getStatus() == VerificationStatus::Accepted ) {
            $level = NotificationLevel::Success;
            $text = '<div>Your Request to Verify <strong>' . $verificationRequest->getArtist()->getName() . '</strong> has been accepted.</div>';
            $text .= '<div class="small">Go to "My Artists" to find your new Artist.</div>';
        }
        
        $this->notificationService->createNotification($level, $text, NotificationStatus::Unread, $verificationRequest->getUser());
    }
}