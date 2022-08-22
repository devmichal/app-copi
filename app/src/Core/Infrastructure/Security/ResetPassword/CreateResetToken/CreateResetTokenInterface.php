<?php

namespace App\Core\Infrastructure\Security\ResetPassword\CreateResetToken;

use App\Core\Application\RetryPassword\UserExist\DTO\NewResetTokenDTO;

interface CreateResetTokenInterface
{
    public function createToken(): NewResetTokenDTO;
}
