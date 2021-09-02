<?php

namespace App\Core\Infrastructure\Service\AggregateDate;


use DateTime;


final class LastDayOfMonth
{

    public static function getDay(): string
    {
        $dateTime = new DateTime();

        return date('t', strtotime($dateTime->format('Y-m')));
    }
}