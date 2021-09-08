<?php

namespace App\Core\Domain\Logic\CalculatePayout;


final class SumPayoutTaskOfMonth implements SumPayoutTaskOfMonthInterface
{

    /**
     * @param array|null $tasks
     * @return float
     */
    public function sumPayout(?array $tasks): float
    {
        $sumMonth = 0;

        if (!$tasks) {

           return $sumMonth;
        }

        foreach ($tasks as $task) {

            $sumMonth += $task->getWalletTask()->getMoney();
        }

        return $sumMonth;
    }
}