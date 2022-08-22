<?php

namespace App\Core\Infrastructure\Security\ResetPassword;

use App\Core\Domain\Model\Users\User;

interface ValidateTokenResetPasswordInterface
{
    public function tokenIsValid(User $user, string $userToken): void;
}
