<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Task\DeleteTask;

final class DeleteTaskCommand
{
    public const NAME = 'delete.task';

    public function __construct(
       private string $idTask
    ) {
    }

    public function getIdTask(): string
    {
        return $this->idTask;
    }
}
