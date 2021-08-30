<?php

namespace App\Core\Application\RetryPassword\ConfirmToken\DTO;


final class ConfirmTokenPasswordDTO
{
    private string $user;

    private string $userToken;


    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getUserToken(): string
    {
        return $this->userToken;
    }

    /**
     * @param string $userToken
     */
    public function setUserToken(string $userToken): void
    {
        $this->userToken = $userToken;
    }
}