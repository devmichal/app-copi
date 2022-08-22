<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Client\DeleteClient;

use App\Core\Infrastructure\Repository\Client\MatchClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class DeleteClientCommandHandler implements EventSubscriberInterface
{
    public function __construct(
       private EntityManagerInterface $entityManager,
       private MatchClientInterface $matchClient
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
          DeleteClientCommand::NAME => 'deleteClient',
        ];
    }

    public function deleteClient(DeleteClientCommand $clientCommand): void
    {
        $client = $this->matchClient->foundClient($clientCommand->getClientId());

        $this->entityManager->remove($client);
        $this->entityManager->flush();
    }
}
