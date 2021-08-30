<?php


namespace App\Core\Infrastructure\Repository\Client;


use App\Core\Domain\Model\Client\Client;

interface MatchClientInterface
{
    public function foundClient(string $idClient): Client;
}