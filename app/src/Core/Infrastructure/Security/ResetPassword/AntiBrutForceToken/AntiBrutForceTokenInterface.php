<?php

namespace App\Core\Infrastructure\Security\ResetPassword\AntiBrutForceToken;

interface AntiBrutForceTokenInterface
{
    public function isToMoneyWrongToken(string $idUsers): bool;
}
