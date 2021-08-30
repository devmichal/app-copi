<?php

namespace App\Core\Application\Command\UserManagement\UserManagementCreate;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class UserManagementCommandHandler implements EventSubscriberInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return[
          UserManagementCommand::NAME => 'userWallet'
        ];
    }

    public function userWallet(UserManagementCommand $command): void
    {
        $wallet = $command->getUser()->getWallet();

        $wallet->updateWallet($command->getManagementCreate());

        $this->entityManager->persist($wallet);
        $this->entityManager->flush();
    }
}