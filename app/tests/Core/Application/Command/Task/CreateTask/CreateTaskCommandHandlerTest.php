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
    /** @var CreateTaskCommandHandler  */
    private CreateTaskCommandHandler $createTaskCommandHandler;

    /** @var EntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var CalculatePayoutInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $calculatePayout;

    protected function setUp(): void
    {
        $this->entityManager   = $this->createMock(EntityManagerInterface::class);
        $this->calculatePayout = $this->createMock(CalculatePayoutInterface::class);

        $this->createTaskCommandHandler = new CreateTaskCommandHandler(
            $this->entityManager,
            $this->calculatePayout
        );
    }

    public function testShouldCreateNewTask()
    {
        $this->calculatePayout
             ->method('myPayment')
             ->willReturn(12.0);

        $commandTask = $this->createCommand();

        $this->entityManager->expects(self::once())
             ->method('persist')
             ->with(self::callback(fn(Task $task): bool =>
                $task->getTitleTask()            === $commandTask->getCreateTaskDTO()->getTitleTask() &&
                $task->getNumberCountCharacter() === $commandTask->getCreateTaskDTO()->getNumberCountCharacter()
             ));

        $this->createTaskCommandHandler->createTask($commandTask);
    }

    private function createCommand(): CreateTaskCommand
    {
        $createTaskDTO = new CreateTaskDTO();
        $createTaskDTO->setClient(new Client());
        $createTaskDTO->setTitleTask('some title');
        $createTaskDTO->setNumberCountCharacter(123);

        return new CreateTaskCommand($createTaskDTO, new User());
    }
}