<?php

namespace App\Tests\Core\Application\Query\Task\GetTasks;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Application\Query\Task\GetTasks\GetTasksQuery;
use App\Core\Application\Query\Task\GetTasks\GetTasksQueryHandler;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Task\GetUserTasks;
use PHPUnit\Framework\TestCase;

class GetTasksQueryHandlerTest extends TestCase
{
    public const COUNT_TEXT = 1000;
    public const PAYMENT = 141;

    /** @var GetUserTasks|\PHPUnit\Framework\MockObject\MockObject */
    private $getUserTasks;

    /** @var Task|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    /** @var Client|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $client;

    /** @var TypeText|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $typeText;

    protected function setUp(): void
    {
        $this->getUserTasks = $this->createMock(GetUserTasks::class);
        $this->user = $this->createMock(User::class);
        $this->client = $this->createMock(Client::class);
        $this->typeText = $this->createMock(TypeText::class);
    }

    final public function testShouldReturnEmptyArray(): void
    {
        $this->getUserTasks
             ->method('tasks')
             ->willReturn([]);

        $command = new GetTasksQuery(new User());
        $handler = new GetTasksQueryHandler($this->getUserTasks);
        $result = $handler($command);

        $this->assertEmpty($result);
    }

    final public function testShouldFullyArrayOfTask(): void
    {
        $this->getUserTasks
            ->method('tasks')
            ->willReturn($this->createArrayOfTask());

        $command = new GetTasksQuery(new User());
        $handler = new GetTasksQueryHandler($this->getUserTasks);
        $result = $handler($command);

        $this->assertIsArray($result);
        $this->assertEquals(self::COUNT_TEXT, $result[0]->getNumberCountCharacter());
    }

    private function createArrayOfTask(): array
    {
        $createTaskDTO = new CreateTaskDTO();
        $createTaskDTO->setTitleTask('some title');
        $createTaskDTO->setNumberCountCharacter(self::COUNT_TEXT);
        $createTaskDTO->setClient($this->client);
        $createTaskDTO->setTypeText($this->typeText);

        $task = new Task($this->user);
        $task->factoryTask($createTaskDTO, 10);
        $task->updateTaskDate($createTaskDTO);

        return [$task];
    }
}
