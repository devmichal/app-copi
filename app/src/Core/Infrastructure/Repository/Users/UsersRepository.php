<?php

namespace App\Core\Infrastructure\Repository\Users;


use App\Core\Domain\Model\Users\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class UsersRepository extends ServiceEntityRepository implements MatchUser
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUser(string $addressEmail, string $field = 'email'): ?User
    {
        return $this->findOneBy([$field => $addressEmail]);
    }
}