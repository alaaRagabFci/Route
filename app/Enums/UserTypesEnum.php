<?php

namespace App\Enums;

enum UserTypesEnum: string
{
    case DRIVER = 'Driver';
    case USER = 'User';
    case ADMIN = 'Admin';
}
