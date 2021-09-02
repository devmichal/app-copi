<?php


namespace App\Core\Application\Command\Task\CreateTask;


use App\Core\Domain\Logic\CalculatePayout\CalculatePayoutInterface;
use App\Core\Domain\Model\Task\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class CreateTaskCommandHandler implements EventSubscriberInterface
{

    private CalculatePayoutInterface $calculatePayout;

    private EntityManagerInterface $entityManager;


    public function __construct(
        EntityManagerInterface $entityManager,
        CalculatePayoutInterface $calculatePayout
    )
    {
        $this->entityManager = $entityManager;
        $this->calculatePayout = $calculatePayout;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CreateTaskCommand::NAME => 'createTask'
        ];
    }

    public function createTask(CreateTaskCommand $command): void
    {
        $client        = $command->getCreateTaskDTO()->getClient();
        $createTaskDTO = $command->getCreateTaskDTO();
        $user          = $command->getUser();

        $paymentMoney  = $this->calculatePayout->myPayment($client->getSalary(), $createTaskDTO->getNumberCountCharacter());

        $task = new Task($user);
        $task->factoryTask($createTaskDTO, $paymentMoney);

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
