<?php

namespace App\Core\Application\Command\Task\UpdateTask\UpdateDataTimeTask;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Task\Task;

interface UpdateComponentTaskInterface
{
    public function updateTime(Task $task, CreateTaskDTO $createTaskDTO): void;
}
