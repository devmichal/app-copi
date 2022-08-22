<?php

namespace App\Core\Infrastructure\Security\ResetPassword\CreateResetToken;

use App\Core\Application\RetryPassword\UserExist\DTO\NewResetTokenDTO;

final class CreateResetToken implements CreateResetTokenInterface
{
    public const MIN_NUMBER = 10000000;
    public const MAX_NUMBER = 99999999;

    /**
     * @throws \Exception
     */
    public function createToken(): NewResetTokenDTO
    {
        $userToken = random_int(self::MIN_NUMBER, self::MAX_NUMBER);

        $hashToken = password_hash($userToken, PASSWORD_ARGON2ID);

        return new NewResetTokenDTO($hashToken, $userToken);
    }
}
