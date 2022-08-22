<?php

namespace App\Core\Infrastructure\Repository\Client;

use App\Core\Domain\Model\Users\User;

interface UserClients
{
    public function getClients(User $user): ?array;
}
