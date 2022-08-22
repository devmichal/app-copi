<?php

namespace App\Core\Application\Command\User\CreateResetTokenPassword;

use App\Core\Domain\Model\Users\User;

final class CreateResetTokenPasswordCommand
{
    public const NAME = 'create.token';

    private User $user;

    private string $newResetTokenDTO;

    public function __construct(
        User $user,
        string $newResetTokenDTO
    ) {
        $this->user = $user;
        $this->newResetTokenDTO = $newResetTokenDTO;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getNewResetTokenDTO(): string
    {
        return $this->newResetTokenDTO;
    }
}
