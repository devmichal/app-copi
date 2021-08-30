<?php


namespace App\Core\Application\Command\Client\UpdateClient;


use App\Core\Application\Command\Client\CreateClientDTO;


final class UpdateClientCommand
{
    public const NAME = 'update.client';

    private CreateClientDTO $createClientDTO;

    private string $client;


    public function __construct(
        CreateClientDTO $clientDTO,
        string $client
    )
    {
        $this->createClientDTO = $clientDTO;
        $this->client          = $client;
    }

    /**
     * @return CreateClientDTO
     */
    public function getCreateClientDTO(): CreateClientDTO
    {
        return $this->createClientDTO;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }
}