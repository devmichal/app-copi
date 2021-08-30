<?php

namespace App\Core\Infrastructure\Security\ResetPassword\TimeToLiveToken;


interface TimeToLiveTokenInterface
{
    public function isExpirationToken(\DateTime $dateGenerateToken): bool;
}