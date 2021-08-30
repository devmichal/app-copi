<?php


namespace App\Core\Infrastructure\Repository\Task;


use App\Core\Domain\Model\Users\User;

interface GetUserTasks
{
    public function tasks(User $user): array;
}