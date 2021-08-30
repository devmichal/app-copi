<?php

namespace App\Core\Application\Command\User\CreateNewPassword;


use App\Core\Domain\Model\Users\User;
use Doctrine\ORM\EntityManagerInterface;


final class CreateNewUserPassword implements CreateNewUserPasswordInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function newPassword(User $user, string $newPassword): void
    {
        $user->addPassword($newPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}