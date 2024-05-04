<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
    case BLOCKED = 'Blocked';
    case SUSPENDED = 'Suspended';
}
