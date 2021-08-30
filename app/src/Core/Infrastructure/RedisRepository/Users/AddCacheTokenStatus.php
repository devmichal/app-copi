<?php

namespace App\Core\Infrastructure\RedisRepository\Users;

interface AddCacheTokenStatus
{
    public function setCacheIncorrectToken(string $idUser): void;
}