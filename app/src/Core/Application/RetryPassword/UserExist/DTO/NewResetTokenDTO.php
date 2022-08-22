<?php

namespace App\Core\Application\RetryPassword\UserExist\DTO;

final class NewResetTokenDTO
{
    private string $hashToken;

    private string $userToken;

    public function __construct(
        string $hashToken,
        string $userToken
    ) {
        $this->hashToken = $hashToken;
        $this->userToken = $userToken;
    }

    public function getHashToken(): string
    {
        return $this->hashToken;
    }

    public function getUserToken(): string
    {
        return $this->userToken;
    }
}
