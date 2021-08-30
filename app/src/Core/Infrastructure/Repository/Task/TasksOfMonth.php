<?php

namespace App\Core\Infrastructure\Repository\Task;


interface TasksOfMonth
{
    public function getTasks(string $client): array;
}