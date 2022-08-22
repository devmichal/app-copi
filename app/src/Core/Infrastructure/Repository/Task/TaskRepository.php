<?php

namespace App\Core\Infrastructure\Repository\Task;

use App\Core\Application\Query\Task\GetTasks\GetTasksQuery;
use App\Core\Domain\Model\Task\Task;
use App\Core\Infrastructure\Service\AggregateDate\SelectDaysCreatedAt;
use App\Shared\Infrastructure\ValueObject\FilterCreatedAtTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository implements GetUserTasks, MatchTask, TasksOfMonth
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    final public function tasks(GetTasksQuery $getTasksQuery): array
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->where('t.users = :users')

            ->setParameter('users', $getTasksQuery->getUser())
            ->orderBy('t.taskDate.createAt', 'DESC');

        return $qb->getQuery()->getResult();
    }

    final public function foundTask(string $idTask): ?Task
    {
        return $this->findOneBy(['id' => $idTask]);
    }

    final public function getTasks(FilterCreatedAtTask $atTask): array
    {
        $startCreated = SelectDaysCreatedAt::getStartCreatedAt($atTask->getStartCreatedAt());
        $finishCreated = SelectDaysCreatedAt::getFinishCreatedAt($atTask->getFinishCreatedAt());

        $qb = $this->createQueryBuilder('t');
        $qb
            ->where('t.taskDate.createAt >= :firstDay')
            ->andWhere('t.taskDate.createAt <= :lastDay')
            ->andWhere('t.client = :client')

            ->setParameter('firstDay', $startCreated)
            ->setParameter('lastDay', $finishCreated)
            ->setParameter('client', $atTask->getClient())
            ->orderBy('t.taskDate.createAt', 'DESC')
            ;

        return $qb->getQuery()->getResult();
    }
}
