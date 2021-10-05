<?php


namespace App\Core\Application\Command\Task\UpdateTask;


use App\Core\Application\Command\Task\UpdateTask\UpdateDataTimeTask\UpdateComponentTaskInterface;
use App\Core\Domain\Logic\CalculatePayout\CalculatePayoutInterface;
use App\Core\Infrastructure\Repository\Task\MatchTask;
use App\Shared\Domain\Exception\InvalidTask;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class UpdateTaskCommandHandler implements EventSubscriberInterface
{

    private EntityManagerInterface $entityManager;

    private MatchTask $matchTask;

    private CalculatePayoutInterface $calculatePayout;

    private UpdateComponentTaskInterface $updateComponentTask;


    public function __construct(
        EntityManagerInterface $entityManager,
        MatchTask $matchTask,
        CalculatePayoutInterface $calculatePayout,
        UpdateComponentTaskInterface $updateComponentTask
    )
    {
        $this->entityManager = $entityManager;
        $this->matchTask = $matchTask;
        $this->calculatePayout = $calculatePayout;
        $this->updateComponentTask = $updateComponentTask;
    }

    public static function getSubscribedEvents(): array
    {
        return[
          UpdateTaskCommand::NAME => 'updateTask'
        ];
    }

    /**
     * @param UpdateTaskCommand $command
     * @throws InvalidTask
     */
    public function updateTask(UpdateTaskCommand $command): void // todo add to another event create, datetime, event-soursing
    {
        $createTaskDTO  = $command->getCreateTaskDTO();
        $client         = $createTaskDTO->getClient();

        $updatedTask    = $this->matchTask->foundTask($command->getTaskId());

        if (!$updatedTask) {

            throw new InvalidTask('No found task');
        }

        $paymentMoney  = $this->calculatePayout->myPayment(
            $client->getSalary(),
            $createTaskDTO->getNumberCountCharacter());

        $this->updateComponentTask->updateTime($updatedTask, $createTaskDTO);
        $updatedTask->factoryTask($createTaskDTO, $paymentMoney);

        $this->entityManager->persist($updatedTask);
        $this->entityManager->flush();
    }
}