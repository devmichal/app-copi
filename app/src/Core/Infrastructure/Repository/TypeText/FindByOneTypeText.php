<?php

namespace App\Core\Infrastructure\Repository\TypeText;

use App\Core\Domain\Model\TypeText\TypeText;

interface FindByOneTypeText
{
    public function findByOneText($id, $key = 'id'): ?TypeText;
}
