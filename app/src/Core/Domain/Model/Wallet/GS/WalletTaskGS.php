<?php


namespace App\Core\Domain\Model\Wallet\GS;


trait WalletTaskGS
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

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
    public function getMoney(): float
    {
        return $this->money;
    }
}