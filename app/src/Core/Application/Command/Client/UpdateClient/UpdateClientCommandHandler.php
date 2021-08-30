<?php


namespace App\Core\Application\Command\Client\UpdateClient;


use App\Core\Infrastructure\Repository\Client\ClientRepositoryInterface;
use App\Core\Infrastructure\Repository\Client\MatchClientInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class UpdateClientCommandHandler implements EventSubscriberInterface
{

    private MatchClientInterface $matchClient;

    private ClientRepositoryInterface $clientRepository;


    public function __construct(
        MatchClientInterface $matchClient,
        ClientRepositoryInterface $clientRepository
    )
    {
        $this->matchClient = $matchClient;
        $this->clientRepository = $clientRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return[
          UpdateClientCommand::NAME => 'updateClient'
        ];
    }

    public function updateClient(UpdateClientCommand $updateClientCommand): void
    {
        $clientDTO = $updateClientCommand->getCreateClientDTO();
        $client    = $this->matchClient->foundClient($updateClientCommand->getClient());

        $client->handler($clientDTO);

        $this->clientRepository->add($client);
    }
}