<?php // src/Config/ClaimStatus.php
namespace App\Config;

enum ClaimStatus: string
{
    case Requested = 'REQUESTED';
    case Denied = 'DENIED';
    case Accepted = 'ACCEPTED';
}