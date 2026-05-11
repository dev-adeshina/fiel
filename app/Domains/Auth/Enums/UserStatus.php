<?php

namespace App\Domains\Auth\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';

    case SUSPENDED = 'suspended';

    case DEACTIVATED = 'deactivated';
}