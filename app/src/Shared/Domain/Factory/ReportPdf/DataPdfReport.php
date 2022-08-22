<?php

namespace App\Shared\Domain\Factory\ReportPdf;

use App\Core\Domain\Logic\CalculatePayout\SumPayoutTaskOfMonthInterface;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Client\MatchClientInterface;
use App\Core\Infrastructure\Repository\Task\TasksOfMonth;
use App\Core\Infrastructure\Service\AggregateDate\SelectDaysCreatedAt;
use App\Shared\Infrastructure\ValueObject\FilterCreatedAtTask;
use DateTime;

final class DataPdfReport implements DataPdfReportInterface
{
    public const GROSS = 'Brutto';
    public const NET = 'Netto';

    private MatchClientInterface $matchClient;

    private SumPayoutTaskOfMonthInterface $sumPayoutTaskOfMonth;

    private TasksOfMonth $tasksOfMonth;

    public function __construct(
        MatchClientInterface $matchClient,
        SumPayoutTaskOfMonthInterface $sumPayoutTaskOfMonth,
        TasksOfMonth $tasksOfMonth
    ) {
        $this->matchClient = $matchClient;
        $this->sumPayoutTaskOfMonth = $sumPayoutTaskOfMonth;
        $this->tasksOfMonth = $tasksOfMonth;
    }

    public function getData(FilterCreatedAtTask $atTask, User $user): array
    {
        $myClient = $this->matchClient->foundClient($atTask->getClient());
        $monthTasks = $this->tasksOfMonth->getTasks($atTask);

        return [
            'client' => $myClient,
            'tasks' => $monthTasks,
            'user' => $user,
            'createAt' => new DateTime(),
            'typeGross' => $myClient->isGross() ? self::GROSS : self::NET,
            'firstDay' => SelectDaysCreatedAt::getStartCreatedAt($atTask->getStartCreatedAt()),
            'lastDayMonth' => SelectDaysCreatedAt::getFinishCreatedAt($atTask->getFinishCreatedAt()),
            'sumPayout' => $this->sumPayoutTaskOfMonth->sumPayout($monthTasks),
        ];
    }
}
