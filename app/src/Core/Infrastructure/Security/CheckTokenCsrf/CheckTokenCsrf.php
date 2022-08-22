<?php

namespace App\Core\Infrastructure\Security\CheckTokenCsrf;

use App\Core\Infrastructure\RedisRepository\Csrf\GetCsrfSession;
use App\Shared\Domain\Exception\InvalidCsrfToken;

final class CheckTokenCsrf implements CheckTokenCsrfInterface
{
    private GetCsrfSession $getCsrfSession;

    public function __construct(
        GetCsrfSession $getCsrfSession
    ) {
        $this->getCsrfSession = $getCsrfSession;
    }

    /**
     * @throws InvalidCsrfToken
     */
    public function isCorrect(string $idUser, string $tokenCsrf): void
    {
        $csrfSession = $this->getCsrfSession->getSession($idUser);

        if ($csrfSession !== $tokenCsrf) {
            throw new InvalidCsrfToken('Csrf token is invalid');
        }
    }
}
