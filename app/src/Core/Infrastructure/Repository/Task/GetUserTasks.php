<?php

namespace App\Core\Infrastructure\Repository\Task;

use App\Core\Application\Query\Task\GetTasks\GetTasksQuery;

interface GetUserTasks
{
    public function tasks(GetTasksQuery $getTasksQuery): array;
}
