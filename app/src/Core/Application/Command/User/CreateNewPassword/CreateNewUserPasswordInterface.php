<?php

namespace App\Core\Application\Command\User\CreateNewPassword;

use App\Core\Domain\Model\Users\User;

interface CreateNewUserPasswordInterface
{
    public function newPassword(User $user, string $newPassword): void;
}
