<?php

namespace App\Core\Application\Command\UserManagement\UserManagementCreate;

use App\Core\Application\Command\UserManagement\UserManagementCreate;
use App\Core\Domain\Model\Users\User;

final class UserManagementCommand
{
    public const NAME = 'user.wallet';

    private User $user;

    private UserManagementCreate $managementCreate;

    public function __construct(
        User $user,
        UserManagementCreate $managementCreate
    ) {
        $this->user = $user;
        $this->managementCreate = $managementCreate;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getManagementCreate(): UserManagementCreate
    {
        return $this->managementCreate;
    }
}
