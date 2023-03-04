<?php

declare(strict_types=1);

namespace App\Security\Enum;

enum UserRolesEnum: string
{
    case Admin = 'ROLE_ADMIN';
    case User = 'ROLE_USER';
}
