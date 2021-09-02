<?php

namespace App\Tests\Core\Infrastructure\Service\AggregateDate;


use App\Core\Infrastructure\Service\AggregateDate\LastDayOfMonth;
use PHPUnit\Framework\TestCase;

class SortDayMonthTest extends TestCase
{
    final public function testShouldReturnLastDayOfMonth(): void
    {
        $dateTime = new \DateTime();

        $date = date('t', strtotime($dateTime->format('Y-m')));
        $result = LastDayOfMonth::getDay();

        $this->assertEquals($date, $result);
    }

}