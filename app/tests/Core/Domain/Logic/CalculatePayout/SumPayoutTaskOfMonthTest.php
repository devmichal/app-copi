<?php

namespace App\Tests\Core\Domain\Logic\CalculatePayout;

use App\Core\Domain\Logic\CalculatePayout\SumPayoutTaskOfMonth;
use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Wallet\Wallet;
use App\Core\Domain\Model\Wallet\WalletTask;
use App\Core\Infrastructure\Repository\Task\TasksOfMonth;
use PHPUnit\Framework\TestCase;


class SumPayoutTaskOfMonthTest extends TestCase
{
    const ID_CLIENT = 'some_id';
    const ZERO      = 0;

    /** @var SumPayoutTaskOfMonth */
    private $sumPayoutTaskOfMonth;

    /** @var TasksOfMonth|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $tasksOfMonth;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $secoondTask;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $firstTask;

    protected function setUp(): void
    {
        $this->tasksOfMonth = $this->createMock(TasksOfMonth::class);

        $this->firstTask   = $this->createMock(Task::class);
        $this->secoondTask = $this->createMock(Task::class);

        $this->sumPayoutTaskOfMonth = new SumPayoutTaskOfMonth(
            $this->tasksOfMonth
        );
    }

    public function testShouldReturnZeroClientDoNotHaveAnyTaskOfMonth()
    {
        $result = $this->sumPayoutTaskOfMonth->sumPayout(self::ID_CLIENT);

        $this->assertEquals(self::ZERO, $result);
    }

    public function testShouldReturnSumPayoutOfMonth()
    {
        $this->tasksOfMonth
             ->method('getTasks')
             ->willReturn($this->createTaskOfMonth());

        $result = $this->sumPayoutTaskOfMonth->sumPayout(self::ID_CLIENT);

        $this->assertEquals(64.5, $result);
    }

    private function createTaskOfMonth()
    {
        $walletFirst = new WalletTask();
        $walletFirst->updateVariable(13.4);

        $walletSecond = new WalletTask();
        $walletSecond->updateVariable(51.1);

        $this->firstTask
             ->method('getWalletTask')
             ->willReturn($walletFirst);

        $this->secoondTask
             ->method('getWalletTask')
             ->willReturn($walletSecond);

        return array($this->firstTask, $this->secoondTask);
    }
}