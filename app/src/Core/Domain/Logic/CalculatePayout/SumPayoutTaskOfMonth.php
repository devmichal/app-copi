<?php

namespace App\Core\Domain\Logic\CalculatePayout;

final class SumPayoutTaskOfMonth implements SumPayoutTaskOfMonthInterface
{
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
