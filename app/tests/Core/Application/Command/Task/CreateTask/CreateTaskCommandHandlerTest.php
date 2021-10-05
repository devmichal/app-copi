<?php


namespace App\Tests\Core\Application\Command\Task\CreateTask;


use App\Core\Application\Command\Task\CreateTask\CreateTaskCommand;
use App\Core\Application\Command\Task\CreateTask\CreateTaskCommandHandler;
use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Logic\CalculatePayout\CalculatePayoutInterface;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Users\User;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;


class CreateTaskCommandHandlerTest extends TestCase
{
    public const PAYMENT = 12.0;


    private CreateTaskCommandHandler $createTaskCommandHandler;

    /** @var EntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var CalculatePayoutInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $calculatePayout;

    /** @var Client|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $client;


    final protected function setUp(): void
    {
        $this->entityManager   = $this->createMock(EntityManagerInterface::class);
        $this->calculatePayout = $this->createMock(CalculatePayoutInterface::class);
        $this->client          = $this->createMock(Client::class);

        $this->createTaskCommandHandler = new CreateTaskCommandHandler(
            $this->entityManager,
            $this->calculatePayout
        );
    }

    final public function testShouldCreateNewTask(): void
    {
        $this->calculatePayout
             ->method('myPayment')
             ->willReturn(self::PAYMENT);

        $commandTask = $this->createCommand();

        $this->entityManager->expects(self::once())
             ->method('persist')
             ->with(self::callback(fn(Task $task): bool =>
                $task->getTitleTask()              === $commandTask->getCreateTaskDTO()->getTitleTask() &&
                $task->getNumberCountCharacter()   === $commandTask->getCreateTaskDTO()->getNumberCountCharacter() &&
                $task->getStatus()                 === $commandTask->getCreateTaskDTO()->isStatus() &&
                $task->getWalletTask()->getMoney() === self::PAYMENT
             ));

        $this->createTaskCommandHandler->createTask($commandTask);
    }

    private function createCommand(): CreateTaskCommand
    {
        $createTaskDTO = new CreateTaskDTO();
        $createTaskDTO->setClient($this->client);
        $createTaskDTO->setTitleTask('some title');
        $createTaskDTO->setNumberCountCharacter(123);
        $createTaskDTO->setStatus(true);

        return new CreateTaskCommand($createTaskDTO, new User());
    }
}