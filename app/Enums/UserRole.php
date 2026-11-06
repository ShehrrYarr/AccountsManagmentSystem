<?php

namespace App\Enums;

enum UserRole: string
{
    use HasOptions;

    case Admin = 'admin';
    case Staff = 'staff';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::Staff => 'Staff',
        };
    }
}
