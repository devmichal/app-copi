<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Client\UpdateClient;


use App\Core\Application\Command\Client\CreateClientDTO;


final class UpdateClientCommand
{
    public const NAME = 'update.client';

    public function __construct(
        private CreateClientDTO $clientDTO,
        private string $client
    ){

    }

    public function getCreateClientDTO(): CreateClientDTO
    {
        return $this->clientDTO;
    }

    public function getClient(): string
    {
        return $this->client;
    }
}