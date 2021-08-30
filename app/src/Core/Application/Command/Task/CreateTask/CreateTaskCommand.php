<?php


namespace App\Core\Application\Command\Task\CreateTask;


use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Users\User;


final class CreateTaskCommand
{
    public const NAME = 'create.task';

    private $createTaskDTO;

    private $user;

    public function __construct(
        CreateTaskDTO $createTaskDTO,
        User $user
    )
    {
        $this->createTaskDTO = $createTaskDTO;
        $this->user = $user;
    }

    /**
     * @return CreateTaskDTO
     */
    public function getCreateTaskDTO(): CreateTaskDTO
    {
        return $this->createTaskDTO;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}