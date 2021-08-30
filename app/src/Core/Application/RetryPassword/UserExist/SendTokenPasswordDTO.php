<?php

namespace App\Core\Application\RetryPassword\UserExist;


final class SendTokenPasswordDTO
{
    private ?string $user;


    public function __construct(
        string $userEmail = null
    )
    {
        $this->user = $userEmail;
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @param string|null $user
     */
    public function setUser(?string $user): void
    {
        $this->user = $user;
    }
}