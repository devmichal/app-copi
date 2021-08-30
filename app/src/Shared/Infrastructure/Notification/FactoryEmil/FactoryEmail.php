<?php

namespace App\Shared\Infrastructure\Notification\FactoryEmil;


use App\Shared\Domain\Enum\Email\TypeEmail;
use App\Shared\Infrastructure\Notification\NotificationEmil;


final class FactoryEmail
{
    public static function resetPassword(string $email, string $userToken): NotificationEmil
    {
        return new NotificationEmil(
            TypeEmail::retryPassword()->id(),
            $email,
            [
                'newToken' => $userToken
            ]
        );
    }
}