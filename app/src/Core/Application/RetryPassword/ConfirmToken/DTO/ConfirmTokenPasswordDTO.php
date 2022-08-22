<?php

namespace App\Core\Application\RetryPassword\ConfirmToken\DTO;

final class ConfirmTokenPasswordDTO
{
    private string $user;

    private string $userToken;

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function getUserToken(): string
    {
        return $this->userToken;
    }

    public function setUserToken(string $userToken): void
    {
        $this->userToken = $userToken;
    }
}
