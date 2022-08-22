<?php

namespace App\Core\Infrastructure\RedisRepository\AntiBrutForce;

interface BrutForceManagerCache
{
    public function addKey(string $id): void;

    public function getStatusLogin(): int;

    public function clear(): void;

    public function setWrongLogin(int $sumWrongNumber): void;
}
