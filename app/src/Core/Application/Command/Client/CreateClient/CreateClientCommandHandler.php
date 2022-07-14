<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Client\CreateClient;

use App\Core\Domain\Model\Client\Client;
use App\Core\Infrastructure\Repository\Client\ClientRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class CreateClientCommandHandler implements EventSubscriberInterface
{
    public function __construct(
       private ClientRepositoryInterface $clientRepository
    ){
    }

    public static function getSubscribedEvents(): array
    {
        return[
          CreateClientCommand::NAME => 'createClient'
        ];
    }

    public function createClient(CreateClientCommand $clientCommand): void
    {
        $createClientDTO = $clientCommand->getCreateClientDTO();

        $client = new Client();
        $client->handler($createClientDTO);
        $client->handlerUser($clientCommand->getUser());

        $this->clientRepository->add($client);
    }
}