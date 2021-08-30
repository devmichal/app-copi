<?php

namespace App\Core\Domain\Logic\CalculatePayout;

use App\Core\Infrastructure\Repository\Task\TasksOfMonth;


final class SumPayoutTaskOfMonth implements SumPayoutTaskOfMonthInterface
{
    private TasksOfMonth $tasksOfMonth;


    public function __construct(
        TasksOfMonth $tasksOfMonth
    )
    {
        $this->tasksOfMonth = $tasksOfMonth;
    }

    /**
     * @param string $client
     * @return float
     */
    public function sumPayout(string $client): float
    {
        $monthTasks = $this->tasksOfMonth->getTasks($client);
        $sumMonth   = 0;

        if (!$monthTasks) {
           return $sumMonth;
        }

        foreach ($monthTasks as $task) {
            $sumMonth += $task->getWalletTask()->getMoney();
        }

        return $sumMonth;
    }
}