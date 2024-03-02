<?php // src/Config/PostStatus.php
namespace App\Config;

enum PostStatus: string
{
    case Draft = 'DRAFT';
    case Scheduled = 'SCHEDULED';
    case Published = 'PUBLISHED';
}