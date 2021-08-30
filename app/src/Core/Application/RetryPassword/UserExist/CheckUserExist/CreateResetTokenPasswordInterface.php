<?php

namespace App\Core\Application\RetryPassword\UserExist\CheckUserExist;

use App\Core\Application\RetryPassword\UserExist\SendTokenPasswordDTO;

interface CreateResetTokenPasswordInterface
{
    public function sendEmail(SendTokenPasswordDTO $DTO): void;
}