<?php

namespace App\Core\Infrastructure\Security\CheckTokenCsrf;

interface CheckTokenCsrfInterface
{
    public function isCorrect(string $idUser, string $tokenCsrf): void;
}
