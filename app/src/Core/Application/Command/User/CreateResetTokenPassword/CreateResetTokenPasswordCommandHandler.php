<?php

namespace App\Core\Application\Command\User\CreateResetTokenPassword;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class CreateResetTokenPasswordCommandHandler implements EventSubscriberInterface
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
          CreateResetTokenPasswordCommand::NAME => 'createToken'
        ];
    }

    public function createToken(CreateResetTokenPasswordCommand $command): void
    {
        $user = $command->getUser();

        $user->newTokenResetPassword($command->getNewResetTokenDTO());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}