<?php

namespace App\Tests\Shared\Domain\Factory\ReportPdf;


use App\Core\Domain\Logic\CalculatePayout\SumPayoutTaskOfMonthInterface;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Client\MatchClientInterface;
use App\Core\Infrastructure\Repository\Task\TasksOfMonth;
use App\Shared\Domain\Factory\ReportPdf\DataPdfReport;
use PHPUnit\Framework\TestCase;


class DataPdfReportTest extends TestCase
{
    public const GROSS     = 'Brutto';
    public const NET       = 'Netto';
    public const CLIENT_ID = 'someId';

    /** @var MatchClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $matchClient;

    /** @var SumPayoutTaskOfMonthInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $sumPayoutTaskOfMonth;

    /** @var TasksOfMonth|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $tasksOfMonth;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    /** @var Client|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $client;

    private DataPdfReport $dataPdfReport;


    final protected function setUp(): void
    {
        $this->matchClient          = $this->createMock(MatchClientInterface::class);
        $this->sumPayoutTaskOfMonth = $this->createMock(SumPayoutTaskOfMonthInterface::class);
        $this->tasksOfMonth         = $this->createMock(TasksOfMonth::class);
        $this->user                 = $this->createMock(User::class);
        $this->client               = $this->createMock(Client::class);

        $this->dataPdfReport = new DataPdfReport(
            $this->matchClient,
            $this->sumPayoutTaskOfMonth,
            $this->tasksOfMonth
        );
    }

    final public function testShouldReturnCheckKeyArrayOfDataToBuildPdfReport(): void
    {
        $result = $this->dataPdfReport->getData(self::CLIENT_ID, $this->user);

        $this->assertArrayHasKey('client', $result);
        $this->assertArrayHasKey('tasks', $result);
        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('createAt', $result);
        $this->assertArrayHasKey('typeGross', $result);
        $this->assertArrayHasKey('lastDayMonth', $result);
        $this->assertArrayHasKey('sumPayout', $result);
    }

    final public function testShouldReturnGrossInKeyTypeGross(): void
    {
        $this->client
            ->method('isGross')
            ->willReturn(true);

        $this->matchClient
            ->method('foundClient')
            ->willReturn($this->client);

        $result = $this->dataPdfReport->getData(self::CLIENT_ID, $this->user);

        $this->assertEquals(self::GROSS, $result['typeGross']);
    }

    final public function testShouldReturnNetInKeyTypeGross(): void
    {
        $this->client
            ->method('isGross')
            ->willReturn(false);

        $this->matchClient
            ->method('foundClient')
            ->willReturn($this->client);

        $result = $this->dataPdfReport->getData(self::CLIENT_ID, $this->user);

        $this->assertEquals(self::NET, $result['typeGross']);
    }

}