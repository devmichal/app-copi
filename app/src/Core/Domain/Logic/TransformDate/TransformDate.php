<?php

namespace App\Core\Domain\Logic\TransformDate;

use DateTime;

final class TransformDate
{
    public const FORMAT_HOUR = 'H:i:s';

    public static function createdAt(?string $usersCreatedAt): DateTime
    {
        $actualTime = new DateTime();

        if (!$usersCreatedAt) {
            return $actualTime;
        }

        return new DateTime($usersCreatedAt.$actualTime->format(self::FORMAT_HOUR));
    }
}
