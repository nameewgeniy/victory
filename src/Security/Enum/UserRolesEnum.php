<?php

namespace App\Security\Enum;

enum UserRolesEnum: string
{
    case Admin = 'ROLE_ADMIN';
    case User = 'ROLE_USER';
}
