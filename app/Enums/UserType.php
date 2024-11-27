<?php

namespace App\Enums;

enum UserType: string
{
    case STAFF       = 'staff';
    case ADMIN       = 'admin';
    case SUPER_ADMIN = 'super-admin';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function isStaff(): bool
    {
        return $this == self::SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this == self::ADMIN;
    }

    public function isSuperAdmin(): bool
    {
        return $this == self::SUPER_ADMIN;
    }
}
