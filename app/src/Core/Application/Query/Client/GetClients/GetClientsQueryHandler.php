<?php


namespace App\Core\Application\Query\Client\GetClients;


use App\Core\Application\Query\Client\ClientDTO;
use App\Core\Infrastructure\Repository\Client\UserClients;


final class GetClientsQueryHandler
{
    private UserClients $userClients;


    public function __construct(
        UserClients $userClients
    )
    {
        $this->userClients = $userClients;
    }

    public function __invoke(GetClientsQuery $clientsQuery): ?array
    {
        $clientsData = [];
        $clients     = $this->userClients->getClients($clientsQuery->getUser());

        foreach ($clients as $client) {

            $clientsData[] = ClientDTO::fromEntity($client);
        }

        return $clientsData;
    }
}