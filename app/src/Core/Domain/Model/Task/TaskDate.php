<?php


namespace App\Core\Domain\Model\Task;


use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Task\GS\TaskDateGS;
use DateTime;


final class TaskDate
{
    use TaskDateGS;

    private DateTime $createAt;

    private DateTime $taskDateAt;

    private DateTime $deadLineAt;

    private DateTime $finishTaskAt;

    /**
     * @throws \Exception
     */
    public function __construct(
        CreateTaskDTO $createTaskDTO
    )
    {
        $deadlineAt = $createTaskDTO->getDeadLineAt() ?: '+1 week';
        $createdAt  = $createTaskDTO->getCreatedAt()  ?: 'now';

        $this->createAt     = new DateTime($createdAt);
        $this->finishTaskAt = new DateTime();
        $this->taskDateAt   = new DateTime();
        $this->deadLineAt   = new DateTime($deadlineAt);
    }
}
