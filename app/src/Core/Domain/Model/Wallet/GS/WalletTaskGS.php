<?php

namespace App\Core\Domain\Model\Wallet\GS;

trait WalletTaskGS
{
    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getMoney(): float
    {
        return $this->money;
    }
}
