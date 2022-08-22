<?php

namespace App\Core\Infrastructure\Security\ResetPassword\AntiBrutForceToken;

use App\Core\Infrastructure\RedisRepository\Users\GetCacheTokenStatus;

final class AntiBrutForceToken implements AntiBrutForceTokenInterface
{
    public const COUNT_WRONG_TOKEN = 3;

    private GetCacheTokenStatus $cacheTokenStatus;

    public function __construct(
        GetCacheTokenStatus $cacheTokenStatus
    ) {
        $this->cacheTokenStatus = $cacheTokenStatus;
    }

    public function isToMoneyWrongToken(string $idUsers): bool
    {
        $numberOfAddBadToken = $this->cacheTokenStatus->getCacheBadToken($idUsers);

        if ($numberOfAddBadToken >= self::COUNT_WRONG_TOKEN) {
            $this->cacheTokenStatus->clearCacheToken($idUsers);

            return true;
        }

        return false;
    }
}
