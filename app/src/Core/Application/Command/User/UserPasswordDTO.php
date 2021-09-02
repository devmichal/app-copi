<?php


namespace App\Core\Application\Command\User;


final class UserPasswordDTO
{

    private string $password;

    private string $retryPassword;


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRetryPassword(): string
    {
        return $this->retryPassword;
    }

    /**
     * @param string $retryPassword
     */
    public function setRetryPassword(string $retryPassword): void
    {
        $this->retryPassword = $retryPassword;
    }
}