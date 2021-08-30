<?php

namespace App\Core\Application\Query\UserManagement;

use App\Core\Domain\Model\Wallet\Wallet;


final class WalletDTO
{
    private ?string $bankName = null;

    private ?string $bankNumber = null;

    private ?string $street = null;

    private ?string $zipCode = null;

    private ?string $city = null;

    private ?string $lastUpdate = null;

    private float $earnMoney;


    public static function fromEntity(Wallet $wallet): WalletDTO
    {
        $dto = new self();

        $dto->bankName   = $wallet->getBankName();
        $dto->bankNumber = $wallet->getBankNumber();
        $dto->street     = $wallet->getStreet();
        $dto->zipCode    = $wallet->getZipCode();
        $dto->city       = $wallet->getCity();
        $dto->lastUpdate = $wallet->getUpdatedAt()->format('Y-m-d H:i');
        $dto->earnMoney  = $wallet->getEarnMoney();

        return $dto;
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

    /**
     * @return string|null
     */
    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }


    /**
     * @return float
     */
    public function getEarMoney(): float
    {
        return $this->earnMoney;
    }
}