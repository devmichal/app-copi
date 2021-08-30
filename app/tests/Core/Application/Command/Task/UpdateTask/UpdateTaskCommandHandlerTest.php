<?php

namespace App\Tests\Core\Application\Command\Task\UpdateTask;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Application\Command\Task\UpdateTask\UpdateTaskCommand;
use App\Core\Application\Command\Task\UpdateTask\UpdateTaskCommandHandler;
use App\Core\Domain\Logic\CalculatePayout\CalculatePayoutInterface;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Task\MatchTask;
use App\Shared\Domain\Exception\InvalidTask;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;


class UpdateTaskCommandHandlerTest extends TestCase
{
    const TASK_ID    = 'some_id';
    const PAYMENT    = 123.1;
    const COUNT_TEXT = 1200;

    /** @var EntityManagerInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var MatchTask|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $matchTask;

    /** @var CalculatePayoutInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $calculatePayout;

    /** @var UpdateTaskCommandHandler  */
    private UpdateTaskCommandHandler $updateTaskCommandHandler;

    /** @var Client|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $client;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    protected function setUp(): void
    {
        $this->entityManager   = $this->createMock(EntityManagerInterface::class);
        $this->matchTask       = $this->createMock(MatchTask::class);
        $this->calculatePayout = $this->createMock(CalculatePayoutInterface::class);
        $this->client          = $this->createMock(Client::class);
        $this->user            = $this->createMock(User::class);

        $this->updateTaskCommandHandler = new UpdateTaskCommandHandler(
            $this->entityManager,
            $this->matchTask,
            $this->calculatePayout
        );
    }

    public function testShouldReturnExceptionNotFoundTask()
    {
        $this->expectException(InvalidTask::class);

        $createTaskDTO = new CreateTaskDTO();
        $updateTask = new UpdateTaskCommand($createTaskDTO, self::TASK_ID);

        $this->updateTaskCommandHandler->updateTask($updateTask);
    }

    public function testShouldUpdateTask()
    {
        $updateTaskCommand = $this->prepareTaskCommand();
        $updateTask        = $updateTaskCommand->getCreateTaskDTO();

        $this->matchTask
             ->method('foundTask')
             ->willReturn($this->createTask());

        $this->calculatePayout
             ->method('myPayment')
             ->willReturn(self::PAYMENT);

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with(self::callback(fn(Task $task): bool =>
                $task->getTitleTask() === $updateTask->getTitleTask() &&
                $task->getWalletTask()->getMoney() === self::PAYMENT &&
                $task->getNumberCountCharacter() === self::COUNT_TEXT
            ));

        $this->updateTaskCommandHandler->updateTask($updateTaskCommand);
    }

    private function prepareTaskCommand(): UpdateTaskCommand
    {
        $createTaskDTO = new CreateTaskDTO();
        $createTaskDTO->setClient($this->client);
        $createTaskDTO->setNumberCountCharacter(self::COUNT_TEXT);
        $createTaskDTO->setTitleTask('some title');

        return new UpdateTaskCommand($createTaskDTO, self::TASK_ID);
    }

    private function createTask(): Task
    {
        return new Task($this->user);
    }
}