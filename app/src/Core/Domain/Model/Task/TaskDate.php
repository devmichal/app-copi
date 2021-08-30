<?php


namespace App\Core\Domain\Model\Task;


use App\Core\Domain\Model\Task\GS\TaskDateGS;

final class TaskDate
{
    use TaskDateGS;

    /** @var \DateTime */
    private $createAt;

    /** @var \DateTime */
    private $taskDateAt;

    /** @var \DateTime */
    private $deadLineAt;

    /** @var string */
    private $finishTaskAt;

    public function __construct()
    {
        $this->createAt     = new \DateTime();
        $this->finishTaskAt = new \DateTime();
        $this->taskDateAt   = new \DateTime();
        $this->deadLineAt   = new \DateTime('+1 week');
    }

}
