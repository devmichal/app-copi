<?php

namespace App\Core\Infrastructure\RedisRepository\Csrf;

interface GetCsrfSession
{
    public function getSession(string $idUser): string;
}