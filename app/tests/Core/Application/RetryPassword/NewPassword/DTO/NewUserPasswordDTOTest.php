<?php

namespace App\Tests\Core\Application\RetryPassword\NewPassword\DTO;

use App\Core\Application\RetryPassword\NewPassword\DTO\NewUserPasswordDTO;

final class NewUserPasswordDTOTest
{

    public static function createUserData(): NewUserPasswordDTO
    {
        $dto = new NewUserPasswordDTO();

        $dto->setTokenCsrf('123');
        $dto->setUserToken('143');
        $dto->setUser('some@gmail.com');
        $dto->setNewPassword('qwerty');
        $dto->setRetryNewPassword('qwerty');

        return $dto;
    }
}