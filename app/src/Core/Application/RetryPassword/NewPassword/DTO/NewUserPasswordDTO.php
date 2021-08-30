<?php

namespace App\Core\Application\RetryPassword\NewPassword\DTO;


final class NewUserPasswordDTO
{
    private string $tokenCsrf;

    private string $userToken;

    private string $user;

    private string $newPassword;

    private string $retryNewPassword;


    /**
     * @return string
     */
    public function getTokenCsrf(): string
    {
        return $this->tokenCsrf;
    }

    /**
     * @param string $tokenCsrf
     */
    public function setTokenCsrf(string $tokenCsrf): void
    {
        $this->tokenCsrf = $tokenCsrf;
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
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    /**
     * @param string $newPassword
     */
    public function setNewPassword(string $newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    /**
     * @return string
     */
    public function getRetryNewPassword(): string
    {
        return $this->retryNewPassword;
    }

    /**
     * @param string $retryNewPassword
     */
    public function setRetryNewPassword(string $retryNewPassword): void
    {
        $this->retryNewPassword = $retryNewPassword;
    }
}