<?php


namespace App\Core\Application\Query\Task\GetTasks;


use App\Core\Application\Query\Task\TaskDTO;
use App\Core\Infrastructure\Repository\Task\GetUserTasks;


final class GetTasksQueryHandler
{
    private GetUserTasks $getUserTasks;


    public function __construct(
        GetUserTasks $getUserTasks
    )
    {
        $this->getUserTasks = $getUserTasks;
    }

    /**
     * @param GetTasksQuery $getTasksQuery
     * @return array
     */
    public function __invoke(GetTasksQuery $getTasksQuery): array
    {
        $tasks = $this->getUserTasks->tasks($getTasksQuery);
        $data  = array();

        foreach ($tasks as $task) {
            $data[] = TaskDTO::fromEntity($task);
        }

        return $data;
    }
}