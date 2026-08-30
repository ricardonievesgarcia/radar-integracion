<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVO = 'ACTIVO';
    case BLOQUEADO = 'BLOQUEADO';
    case INACTIVO = 'INACTIVO';
}
