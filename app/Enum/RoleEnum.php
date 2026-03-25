<?php

namespace App\Enum;

enum RoleEnum: int
{
    case USER = 1;
    case ADMIN = 2;

    public function getName(): string
    {
        return match ($this)
        {
            self::USER => 'Usuário',
            self::ADMIN => 'Administrador',
            default => 'Perfil de usuário não encontrado'
        };
    }
}
