<?php

namespace App\Core\Infrastructure\RedisRepository\Csrf;

interface CreateCsrfSession
{
    public function createSession(string $idUser, string $csrfToken): void;
}
