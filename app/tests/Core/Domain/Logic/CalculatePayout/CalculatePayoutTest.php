<?php

namespace App\Tests\Core\Domain\Logic\CalculatePayout;

use App\Core\Domain\Logic\CalculatePayout\CalculatePayout;
use PHPUnit\Framework\TestCase;

class CalculatePayoutTest extends TestCase
{
    public const SALARY_ONE = 24.5;
    public const SALARY_TWO = 10;
    public const LENGTH_ONE = 2200;

    private CalculatePayout $calculatePayout;

    protected function setUp(): void
    {
        $this->calculatePayout = new CalculatePayout();
    }

    public function testShouldReturnCalculationPayoutOfText()
    {
        $result = $this->calculatePayout->myPayment(self::SALARY_ONE, self::LENGTH_ONE);

        $this->assertEquals(53.9, $result);
    }
}
