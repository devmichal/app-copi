<?php

namespace App\Core\Infrastructure\Repository\Client;

use App\Core\Domain\Model\Client\Client;

interface ClientRepositoryInterface
{
    public function add(Client $client): void;
}
