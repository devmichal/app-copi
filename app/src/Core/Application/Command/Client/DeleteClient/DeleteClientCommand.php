<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Client\DeleteClient;

final class DeleteClientCommand
{
    public const NAME = 'delete.client';

    public function __construct(
        private string $clientId
    ) {
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }
}
