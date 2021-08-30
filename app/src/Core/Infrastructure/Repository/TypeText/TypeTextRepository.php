<?php


namespace App\Core\Infrastructure\Repository\TypeText;


use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TypeTextRepository extends ServiceEntityRepository implements FindByOneTypeText, FindByTypeText, MatchTextType
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeText::class);
    }

    public function findByOneText($id, $key = 'id'): ?TypeText
    {
        return $this->findOneBy([$key => $id]);
    }

    public function findByText(User $user): array
    {
        return $this->findBy(['user' => $user]);
    }

    public function getTypeText(User $user): array
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->where('t.user = :user')

            ->setParameter('user', $user)
            ->orderBy('t.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }
}