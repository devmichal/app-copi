<?php

namespace App\Core\Application\RetryPassword\NewPassword\DTO;

final class NewUserPasswordDTO
{
    private string $tokenCsrf;

    private string $userToken;

    private string $user;

    private string $newPassword;

    private string $retryNewPassword;

    public function getTokenCsrf(): string
    {
        return $this->tokenCsrf;
    }

    public function setTokenCsrf(string $tokenCsrf): void
    {
        $this->tokenCsrf = $tokenCsrf;
    }

    public function getUserToken(): string
    {
        return $this->userToken;
    }

    public function setUserToken(string $userToken): void
    {
        $this->userToken = $userToken;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    public function getRetryNewPassword(): string
    {
        return $this->retryNewPassword;
    }

    public function setRetryNewPassword(string $retryNewPassword): void
    {
        $this->retryNewPassword = $retryNewPassword;
    }
}
