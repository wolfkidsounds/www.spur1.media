<?php // src/EventListener/ClaimRequestChangedListener.php
namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Config\ClaimStatus;
use App\Config\NotificationLevel;
use App\Config\NotificationStatus;
use App\Entity\ClaimRequest;
use App\Service\NotificationService;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::postPersist,  method: 'postPersist',  entity: ClaimRequest::class)]
#[AsEntityListener(event: Events::postUpdate,   method: 'postUpdate',   entity: ClaimRequest::class)]
class ClaimRequestChangedListener
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function postPersist(ClaimRequest $claimRequest, PostPersistEventArgs $event): void
    {
        $this->createNotification($claimRequest);
    }

    public function postUpdate(ClaimRequest $claimRequest, PostUpdateEventArgs $event): void
    {
        $this->createNotification($claimRequest);
    }

    public function createNotification(ClaimRequest $claimRequest): void
    {
    
        if( $claimRequest->getStatus() == ClaimStatus::Requested ) {
            $level = NotificationLevel::Info;
            $text = '<div>Your Request to Claim <strong>' . $claimRequest->getArtist()->getName() . '</strong> has been received.</div>';
        }
    
        if( $claimRequest->getStatus() == ClaimStatus::Denied ) {
            $level = NotificationLevel::Error;
            $text = '<div>Your Request to Claim <strong>' . $claimRequest->getArtist()->getName() . '</strong> has been rejected.</div>';
            $text .= '<br>';
            $text .= $claimRequest->getReason();
        }
    
        if( $claimRequest->getStatus() == ClaimStatus::Accepted ) {
            $level = NotificationLevel::Success;
            $text = '<div>Your Request to Claim <strong>' . $claimRequest->getArtist()->getName() . '</strong> has been accepted.</div>';
        }
        
        $this->notificationService->createNotification($level, $text, NotificationStatus::Unread, $claimRequest->getUser());
    }
}