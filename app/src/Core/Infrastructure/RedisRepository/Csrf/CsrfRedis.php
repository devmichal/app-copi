<?php

namespace App\Core\Infrastructure\RedisRepository\Csrf;

use App\Core\Infrastructure\RedisRepository\RedisConfig;

final class CsrfRedis extends RedisConfig implements GetCsrfSession, CreateCsrfSession
{
    public const KEY_REDIS_CSRF = 'csrf-';
    public const TIMEOUT_CSRF = 360;

    public function getSession(string $idUser): string
    {
        return $this->readCache(self::KEY_REDIS_CSRF.$idUser);
    }

    public function createSession(string $idUser, string $csrfToken): void
    {
        $this->createCache(self::KEY_REDIS_CSRF.$idUser, $csrfToken, self::TIMEOUT_CSRF);
    }
}
