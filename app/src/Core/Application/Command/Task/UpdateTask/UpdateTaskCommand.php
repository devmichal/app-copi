<?php


namespace App\Core\Application\Command\Task\UpdateTask;


use App\Core\Application\Command\Task\CreateTaskDTO;


final class UpdateTaskCommand
{
    public const NAME = 'update.task';

    private CreateTaskDTO $createTaskDTO;

    private string $taskId;


    public function __construct(
        CreateTaskDTO $createTaskDTO,
        string $taskId
    )
    {
        $this->createTaskDTO = $createTaskDTO;
        $this->taskId = $taskId;
    }

    /**
     * @return CreateTaskDTO
     */
    public function getCreateTaskDTO(): CreateTaskDTO
    {
        return $this->createTaskDTO;
    }

    /**
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->taskId;
    }
}