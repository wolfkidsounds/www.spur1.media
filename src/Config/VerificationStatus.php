<?php // src/Config/VerificationStatus.php
namespace App\Config;

enum VerificationStatus: string
{
    case Requested = 'REQUESTED';
    case Denied = 'DENIED';
    case Accepted = 'ACCEPTED';
}