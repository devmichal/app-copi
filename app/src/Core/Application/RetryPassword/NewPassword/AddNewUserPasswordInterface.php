<?php

namespace App\Core\Application\RetryPassword\NewPassword;

use App\Core\Application\RetryPassword\NewPassword\DTO\NewUserPasswordDTO;


interface AddNewUserPasswordInterface
{
    public function addNewPassword(NewUserPasswordDTO $userPasswordDTO): void;
}