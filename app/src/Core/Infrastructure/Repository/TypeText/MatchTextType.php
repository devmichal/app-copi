<?php

namespace App\Core\Infrastructure\Repository\TypeText;

use App\Core\Domain\Model\Users\User;

interface MatchTextType
{
    public function getTypeText(User $user): array;
}
