<?php

namespace App\Shared\Domain\Enum\Email;

use HappyTypes\EnumerableType;

final class TypeEmail extends EnumerableType
{
    public static function retryPassword(): TypeEmail
    {
        return self::get(1, 'Reset password');
    }

    public static function createdUser(): TypeEmail
    {
        return self::get(2, 'Create you`r account');
    }
}