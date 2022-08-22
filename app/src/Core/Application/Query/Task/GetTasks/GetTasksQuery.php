<?php

namespace App\Core\Application\Query\Task\GetTasks;

use App\Core\Domain\Model\Users\User;

final class GetTasksQuery
{
    private User $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
