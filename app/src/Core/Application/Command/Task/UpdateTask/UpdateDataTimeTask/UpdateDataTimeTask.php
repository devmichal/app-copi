<?php

namespace App\Core\Application\Command\Task\UpdateTask\UpdateDataTimeTask;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Task\Task;
use Doctrine\ORM\EntityManagerInterface;

final class UpdateDataTimeTask implements UpdateComponentTaskInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function updateTime(Task $task, CreateTaskDTO $createTaskDTO): void
    {
        $actualCreatedTask = $task->getTaskDate()->getCreateAt()->format('Y-m-d');
        $updatedCreatedTask = $createTaskDTO->getCreatedAt();

        if ($actualCreatedTask === $updatedCreatedTask) {
            return;
        }

        $task->updateTaskDate($createTaskDTO);

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
