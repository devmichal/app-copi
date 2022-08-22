<?php

namespace App\Core\Infrastructure\Security\ResetPassword\VerifyTokenPassword;

use App\Core\Domain\Model\Users\User;

interface VerifyTokenPasswordInterface
{
    public function isIncorrectToken(User $user, string $userToken): bool;
}
