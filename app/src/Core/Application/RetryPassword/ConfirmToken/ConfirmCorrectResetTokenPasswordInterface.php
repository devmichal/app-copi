<?php

namespace App\Core\Application\RetryPassword\ConfirmToken;

use App\Core\Application\RetryPassword\ConfirmToken\DTO\ConfirmTokenPasswordDTO;

interface ConfirmCorrectResetTokenPasswordInterface
{
    public function checkToken(ConfirmTokenPasswordDTO $confirmTokenPasswordDTO): string;
}
