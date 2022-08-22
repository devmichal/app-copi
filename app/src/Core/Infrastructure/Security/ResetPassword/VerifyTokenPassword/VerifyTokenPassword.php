<?php

namespace App\Core\Infrastructure\Security\ResetPassword\VerifyTokenPassword;

use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\RedisRepository\Users\AddCacheTokenStatus;
use App\Shared\Domain\Exception\InvalidResetToken;

final class VerifyTokenPassword implements VerifyTokenPasswordInterface
{
    private AddCacheTokenStatus $addCacheTokenStatus;

    public function __construct(
        AddCacheTokenStatus $addCacheTokenStatus
    ) {
        $this->addCacheTokenStatus = $addCacheTokenStatus;
    }

    /**
     * @throws InvalidResetToken
     */
    public function isIncorrectToken(User $user, string $userToken): bool
    {
        if (password_verify($userToken, $user->getCodeAuth())) {
            return false;
        }

        $this->addCacheTokenStatus->setCacheIncorrectToken($user->getId());
        throw new InvalidResetToken('Incorrect token');
    }
}
