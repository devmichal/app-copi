<?php

namespace App\Core\Infrastructure\Service\AggregateDate;


final class SortDayMonth
{

    public static function lastDayOfMonth()
    {
        $dateTime = new \DateTime();

        return date('t', strtotime($dateTime->format('Y-m')));
    }
}