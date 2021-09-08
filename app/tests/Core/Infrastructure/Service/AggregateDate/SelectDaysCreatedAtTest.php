<?php

namespace App\Tests\Core\Infrastructure\Service\AggregateDate;

use App\Core\Infrastructure\Service\AggregateDate\SelectDaysCreatedAt;
use DateTime;
use PHPUnit\Framework\TestCase;


class SelectDaysCreatedAtTest extends TestCase
{
    public const START_CREATED = '2021-05-10';


    private string $actualDate;

    private string $lastDay;


    final protected function setUp(): void
    {
        $newDate          = new DateTime();
        $this->actualDate = $newDate->format('Y-m').'-01';
        $this->lastDay    = $newDate->format('Y-m').'-'.date('t', strtotime($newDate->format('Y-m')));
    }

    final public function testShouldReturnFirstDayOfMonth(): void
    {
        $result = SelectDaysCreatedAt::getStartCreatedAt(null);

        $this->assertEquals($this->actualDate, $result);
    }

    final public function testShouldSelectedDayOfUser(): void
    {
        $result = SelectDaysCreatedAt::getStartCreatedAt(self::START_CREATED);

        $this->assertEquals(self::START_CREATED, $result);
    }

    final public function testShouldReturnLastDayOfMonth(): void
    {
        $result = SelectDaysCreatedAt::getFinishCreatedAt(null);

        $this->assertEquals($this->lastDay, $result);
    }
}