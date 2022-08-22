<?php

namespace App\Core\Application\Query\TypeText\GetTypeText;

use App\Core\Domain\Model\Users\User;

final class TypeTextQuery
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
