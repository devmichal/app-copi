<?php

namespace App\Shared\Domain\Factory\ReportPdf;


use App\Core\Domain\Logic\CalculatePayout\SumPayoutTaskOfMonthInterface;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Client\MatchClientInterface;
use App\Core\Infrastructure\Repository\Task\TasksOfMonth;
use App\Core\Infrastructure\Service\AggregateDate\SortDayMonth;
use DateTime;


final class DataPdfReport implements DataPdfReportInterface
{
    public const GROSS = 'Brutto';
    public const NET   = 'Netto';


    private MatchClientInterface $matchClient;

    private SumPayoutTaskOfMonthInterface $sumPayoutTaskOfMonth;

    private TasksOfMonth $tasksOfMonth;


    public function __construct(
        MatchClientInterface $matchClient,
        SumPayoutTaskOfMonthInterface $sumPayoutTaskOfMonth,
        TasksOfMonth $tasksOfMonth
    )
    {
        $this->matchClient = $matchClient;
        $this->sumPayoutTaskOfMonth = $sumPayoutTaskOfMonth;
        $this->tasksOfMonth = $tasksOfMonth;
    }

    /**
     * @param string $client
     * @param User $user
     * @return array
     */
    public function getData(string $client, User $user): array
    {
        $myClient   = $this->matchClient->foundClient($client);
        $monthTasks = $this->tasksOfMonth->getTasks($client);

        return [
            'client'       => $myClient,
            'tasks'        => $monthTasks,
            'user'         => $user,
            'createAt'     => new DateTime(),
            'typeGross'    => $myClient->isGross() ? self::GROSS : self::NET,
            'lastDayMonth' => SortDayMonth::lastDayOfMonth(),
            'sumPayout'    => $this->sumPayoutTaskOfMonth->sumPayout($client)
        ];
    }
}