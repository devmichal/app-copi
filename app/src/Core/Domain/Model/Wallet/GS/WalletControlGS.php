<?php


namespace App\Core\Domain\Model\Wallet\GS;


trait WalletControlGS
{
    /**
     * @return \DateTime
     */
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