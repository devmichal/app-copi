<?php


namespace App\Core\Infrastructure\Repository\Task;


use App\Core\Domain\Model\Task\Task;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Service\AggregateDate\SortDayMonth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class TaskRepository extends ServiceEntityRepository implements GetUserTasks, MatchTask, TasksOfMonth
{
     public function __construct(ManagerRegistry $registry)
     {
         parent::__construct($registry, Task::class);
     }

    public function tasks(User $user): array
    {
        $monthDay         = new \DateTime();
        $lastDayOfMonth   = SortDayMonth::lastDayOfMonth();
        $aggregateMothYer = $monthDay->format('Y-m');

        $qb = $this->createQueryBuilder('t');
        $qb
            ->where('t.users = :users')
            ->andWhere('t.taskDate.createAt >= :firstDay')
            ->andWhere('t.taskDate.createAt <= :lastDay')

            ->setParameter('firstDay', $aggregateMothYer.".01")
            ->setParameter('lastDay', $aggregateMothYer.'.'.$lastDayOfMonth)
            ->setParameter('users', $user)
            ->orderBy('t.taskDate.createAt', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function foundTask(string $idTask): ?Task
    {
        return $this->findOneBy(['id'=>$idTask]);
    }

    public function getTasks(string $client): array
    {
        $monthDay         = new \DateTime();
        $lastDayOfMonth   = SortDayMonth::lastDayOfMonth();
        $aggregateMothYer = $monthDay->format('Y-m');

        $qb = $this->createQueryBuilder('t');
        $qb
            ->where('t.taskDate.createAt >= :firstDay')
            ->andWhere('t.taskDate.createAt <= :lastDay')
            ->andWhere('t.client = :client')

            ->setParameter('firstDay', $aggregateMothYer.".01")
            ->setParameter('lastDay', $aggregateMothYer.'.'.$lastDayOfMonth)
            ->setParameter('client', $client)
            ;

        return $qb->getQuery()->getResult();
    }
}