<?php

namespace App\Core\Domain\Model\Wallet\GS;

trait WalletGS
{
    public function getEarnMoney(): float
    {
        return $this->earnMoney;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
}
