<?php

namespace App\Core\Infrastructure\Service\AggregateDate;

use DateTime;

final class SelectDaysCreatedAt
{
    public static function getStartCreatedAt(?string $startCreatedAt): string
    {
        if ($startCreatedAt) {
            $date = new DateTime($startCreatedAt);

            return $date->format('Y-m-d');
        }

        $date = new DateTime();

        return $date->format('Y-m').'-01';
    }

    public static function getFinishCreatedAt(?string $finishCreatedAt): string
    {
        if ($finishCreatedAt) {
            $date = new DateTime($finishCreatedAt);

            return $date->format('Y-m-d');
        }

        $dateTime = new DateTime();

        return $dateTime->format('Y-m').'-'.date('t', strtotime($dateTime->format('Y-m')));
    }
}
