<?php

namespace App\Shared\Domain\Enum\Email;

enum TypeEmail: int
{
    case RESET_PASSWORD = 1;
    case CREATE_ACCOUNT = 2;
}