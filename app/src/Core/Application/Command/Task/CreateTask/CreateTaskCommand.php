<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Task\CreateTask;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Users\User;

final class CreateTaskCommand
{
    public const NAME = 'create.task';

    public function __construct(
        private CreateTaskDTO $createTaskDTO,
        private User $user
    ) {
    }

    public function getCreateTaskDTO(): CreateTaskDTO
    {
        return $this->createTaskDTO;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
