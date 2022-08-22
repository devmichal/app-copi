<?php

namespace App\Core\Domain\Model\Wallet\GS;

trait WalletControlGS
{
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return float
     */
    public function getMoney()
    {
        return $this->money;
    }
}
