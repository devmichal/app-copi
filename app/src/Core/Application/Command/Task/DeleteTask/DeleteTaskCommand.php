<?php

namespace App\Core\Application\Command\Task\DeleteTask;


final class DeleteTaskCommand
{
    public const NAME = 'delete.task';

    private string $idTask;


    public function __construct(
        string $idTask
    )
    {
        $this->idTask = $idTask;
    }

    /**
     * @return string
     */
    public function getIdTask(): string
    {
        return $this->idTask;
    }
}