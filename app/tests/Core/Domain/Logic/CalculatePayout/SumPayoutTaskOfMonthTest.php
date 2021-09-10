<?php

namespace App\Tests\Core\Domain\Logic\CalculatePayout;

use App\Core\Domain\Logic\CalculatePayout\SumPayoutTaskOfMonth;
use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Wallet\WalletTask;
use PHPUnit\Framework\TestCase;


class SumPayoutTaskOfMonthTest extends TestCase
{
    public const ID_CLIENT = 'some_id';
    public const ZERO      = 0;


    private SumPayoutTaskOfMonth $sumPayoutTaskOfMonth;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $secoondTask;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $firstTask;

    final protected function setUp(): void
    {
        $this->firstTask   = $this->createMock(Task::class);
        $this->secoondTask = $this->createMock(Task::class);

        $this->sumPayoutTaskOfMonth = new SumPayoutTaskOfMonth();
    }

    final public function testShouldReturnZeroClientDoNotHaveAnyTaskOfMonth(): void
    {
        $result = $this->sumPayoutTaskOfMonth->sumPayout(null);

        $this->assertEquals(self::ZERO, $result);
    }

    final public function testShouldReturnSumPayoutOfMonth(): void
    {
        $result = $this->sumPayoutTaskOfMonth->sumPayout($this->createTaskOfMonth());

        $this->assertEquals(64.5, $result);
    }

    private function createTaskOfMonth(): array
    {
        $walletFirst = new WalletTask(13.4);

        $walletSecond = new WalletTask(51.1);

        $this->firstTask
             ->method('getWalletTask')
             ->willReturn($walletFirst);

        $this->secoondTask
             ->method('getWalletTask')
             ->willReturn($walletSecond);

        return array($this->firstTask, $this->secoondTask);
    }
}