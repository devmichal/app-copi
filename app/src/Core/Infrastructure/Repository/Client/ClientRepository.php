<?php

namespace App\Core\Infrastructure\Repository\Client;

use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Users\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository implements MatchClientInterface, ClientRepositoryInterface, UserClients
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function add(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }

    public function foundClient(string $idClient): Client
    {
        return $this->find($idClient);
    }

    public function getClients(User $user): ?array
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where('c.user = :user')

            ->setParameter('user', $user)
            ->orderBy('c.createAt', 'DESC')
            ;

        return $qb->getQuery()->getResult();
    }
}
