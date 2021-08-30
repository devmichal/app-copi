<?php

namespace App\Core\Application\Command\User\BlockUserAccount;

final class BlockUserCommand
{
    public const NAME = 'disable.account';

    private string $username;

    public function __construct(
        string $username
    )
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}