<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Task\UpdateTask;

use App\Core\Application\Command\Task\UpdateTask\UpdateDataTimeTask\UpdateComponentTaskInterface;
use App\Core\Domain\Logic\CalculatePayout\CalculatePayoutInterface;
use App\Core\Infrastructure\Repository\Task\MatchTask;
use App\Shared\Domain\Exception\InvalidTask;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class UpdateTaskCommandHandler implements EventSubscriberInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MatchTask $matchTask,
        private CalculatePayoutInterface $calculatePayout,
        private UpdateComponentTaskInterface $updateComponentTask
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
          UpdateTaskCommand::NAME => 'updateTask',
        ];
    }

    /**
     * @throws InvalidTask
     */
    public function updateTask(UpdateTaskCommand $command): void // todo add to another event create, datetime, event-soursing
    {
        $createTaskDTO = $command->getCreateTaskDTO();
        $client = $createTaskDTO->getClient();

        $updatedTask = $this->matchTask->foundTask($command->getTaskId());

        if (!$updatedTask) {
            throw new InvalidTask('No found task');
        }

        $paymentMoney = $this->calculatePayout->myPayment(
            $client->getSalary(),
            $createTaskDTO->getNumberCountCharacter());

        $this->updateComponentTask->updateTime($updatedTask, $createTaskDTO);
        $updatedTask->factoryTask($createTaskDTO, $paymentMoney);

        $this->entityManager->persist($updatedTask);
        $this->entityManager->flush();
    }
}
