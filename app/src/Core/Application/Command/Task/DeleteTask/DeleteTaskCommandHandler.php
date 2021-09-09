<?php

namespace App\Core\Application\Command\Task\DeleteTask;


use App\Core\Infrastructure\Repository\Task\MatchTask;
use App\Shared\Domain\Exception\InvalidTask;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class DeleteTaskCommandHandler implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;

    private MatchTask $matchTask;


    public function __construct(
        EntityManagerInterface $entityManager,
        MatchTask $matchTask
    )
    {
        $this->entityManager = $entityManager;
        $this->matchTask = $matchTask;
    }

    public static function getSubscribedEvents(): array
    {
        return[
          DeleteTaskCommand::NAME => 'deleteTask'
        ];
    }

    /**
     * @param DeleteTaskCommand $command
     * @throws InvalidTask
     */
    final public function deleteTask(DeleteTaskCommand $command): void
    {
        $task = $this->matchTask->foundTask($command->getIdTask());

        if (!$task) {

            throw new InvalidTask('Task not exist');
        }

        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
}