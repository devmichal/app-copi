<?php

namespace App\Core\Infrastructure\Repository\Task;


use App\Shared\Infrastructure\ValueObject\FilterCreatedAtTask;

interface TasksOfMonth
{
    public function getTasks(FilterCreatedAtTask $atTask): array;
}