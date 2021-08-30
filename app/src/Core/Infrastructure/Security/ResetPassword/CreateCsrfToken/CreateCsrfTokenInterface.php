<?php

namespace App\Core\Infrastructure\Security\ResetPassword\CreateCsrfToken;


interface CreateCsrfTokenInterface
{
    public function createCsrfToken(string $userId): string;
}