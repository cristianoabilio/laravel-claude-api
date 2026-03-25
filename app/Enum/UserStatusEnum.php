<?php

namespace App\Enum;

enum UserStatusEnum: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function getName(): string
    {
        return match ($this)
        {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            default => 'Status de usuário não encontrado'
        };
    }
}

