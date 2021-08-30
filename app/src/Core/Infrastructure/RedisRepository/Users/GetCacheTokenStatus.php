<?php

namespace App\Core\Infrastructure\RedisRepository\Users;

interface GetCacheTokenStatus
{
    public function clearCacheToken(string $idUsers): void;

    public function getCacheBadToken(string $idUsers): int;
}