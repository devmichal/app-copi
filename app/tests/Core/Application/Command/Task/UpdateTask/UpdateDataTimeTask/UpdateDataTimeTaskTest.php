<?php

namespace App\Tests\Core\Application\Command\Task\UpdateTask\UpdateDataTimeTask;


use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Application\Command\Task\UpdateTask\UpdateDataTimeTask\UpdateDataTimeTask;
use App\Core\Domain\Model\Task\Task;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UpdateDataTimeTaskTest extends TestCase
{

    private UpdateDataTimeTask $updateDataTimeTask;

    /** @var CreateTaskDTO|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $createTaskDTO;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $task;

    /** @var EntityManagerInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;


    final protected function setUp(): void
    {
        $this->task          = $this->createMock(Task::class);
        $this->createTaskDTO = $this->createMock(CreateTaskDTO::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->updateDataTimeTask = new UpdateDataTimeTask(
            $this->entityManager
        );
    }

    final public function testShouldNotUpdatedDataTime(): void
    {

    }

}