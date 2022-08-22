<?php

namespace App\Core\Infrastructure\Repository\TypeText;

use App\Core\Domain\Model\Users\User;

interface FindByTypeText
{
    public function findByText(User $user): array;
}
