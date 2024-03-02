<?php // src/Config/NotificationStatus.php
namespace App\Config;

enum NotificationStatus: string
{
    case Read = 'read';
    case Unread = 'unread';
}