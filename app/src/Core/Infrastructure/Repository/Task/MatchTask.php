<?php


namespace App\Core\Infrastructure\Repository\Task;


use App\Core\Domain\Model\Task\Task;

interface MatchTask
{
    public function foundTask(string $idTask): ?Task;
}