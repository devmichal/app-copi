<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Task\UpdateTask;

use App\Core\Application\Command\Task\CreateTaskDTO;

final class UpdateTaskCommand
{
    public const NAME = 'update.task';

    public function __construct(
        private CreateTaskDTO $createTaskDTO,
        private string $taskId
    ) {
    }

    public function getCreateTaskDTO(): CreateTaskDTO
    {
        return $this->createTaskDTO;
    }

    public function getTaskId(): string
    {
        return $this->taskId;
    }
}
