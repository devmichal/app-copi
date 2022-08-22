<?php

namespace App\Core\Infrastructure\Security\ResetPassword\TimeToLiveToken;

use DateTime;

interface TimeToLiveTokenInterface
{
    public function isExpirationToken(DateTime $dateGenerateToken): bool;
}
