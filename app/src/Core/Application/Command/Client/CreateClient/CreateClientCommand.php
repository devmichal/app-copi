<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Client\CreateClient;

use App\Core\Application\Command\Client\CreateClientDTO;
use App\Core\Domain\Model\Users\User;

final class CreateClientCommand
{
    public const NAME = 'create.client';

    public function __construct(
        private CreateClientDTO $clientDTO,
        private User $user
    ) {
    }

    public function getCreateClientDTO(): CreateClientDTO
    {
        return $this->clientDTO;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
