<?php

namespace App\Classes\ValueObjects\Constants;


final class Roles
{
    public const USER = 0;

    public const ADMIN = 1;

    public const SUPER_ADMIN = 2;

    public const ROLES_NAMES = [
        0 => 'User',
        1 => 'Admin',
        2 => 'Super Admin',
    ];

}