<?php


namespace App\Core\Domain\Model\Task;


use App\Core\Domain\Model\Task\GS\TaskDateGS;
use DateTime;

final class TaskDate
{
    use TaskDateGS;

    private DateTime $createAt;

    private DateTime $taskDateAt;

    private DateTime $deadLineAt;

    private DateTime $finishTaskAt;

    public function __construct()
    {
        $this->createAt     = new \DateTime();
        $this->finishTaskAt = new \DateTime();
        $this->taskDateAt   = new \DateTime();
        $this->deadLineAt   = new \DateTime('+1 week');
    }
}
