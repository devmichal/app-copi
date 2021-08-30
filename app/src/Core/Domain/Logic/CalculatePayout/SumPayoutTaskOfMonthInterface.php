<?php

namespace App\Core\Domain\Logic\CalculatePayout;

interface SumPayoutTaskOfMonthInterface
{
    public function sumPayout(string $client): float;
}