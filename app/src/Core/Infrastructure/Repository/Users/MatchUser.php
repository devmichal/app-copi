<?php

namespace App\Core\Infrastructure\Repository\Users;


use App\Core\Domain\Model\Users\User;

interface MatchUser
{
    public function getUser(string $addressEmail, string $field = 'email'): ?User;
}