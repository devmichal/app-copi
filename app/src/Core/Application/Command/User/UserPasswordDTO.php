<?php

namespace App\Core\Application\Command\User;

final class UserPasswordDTO
{
    private string $password;

    private string $retryPassword;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRetryPassword(): string
    {
        return $this->retryPassword;
    }

    public function setRetryPassword(string $retryPassword): void
    {
        $this->retryPassword = $retryPassword;
    }
}
