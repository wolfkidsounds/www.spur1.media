<?php // src/Config/NotificationLevel.php
namespace App\Config;

enum NotificationLevel: string
{
    case Info = 'info';
    case Warning = 'warning';
    case Success = 'success';
    case Error = 'error';
}