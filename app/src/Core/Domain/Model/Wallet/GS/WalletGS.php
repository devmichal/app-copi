<?php


namespace App\Core\Domain\Model\Wallet\GS;


use App\Core\Domain\Model\Users\User;
use Doctrine\Common\Collections\ArrayCollection;

trait WalletGS
{
    /**
     * @return float
     */
    public function getEarnMoney(): float
    {
        return $this->earnMoney;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    /**
     * @return string|null
     */
    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

}
