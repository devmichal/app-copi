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

        $dto->bankName = $wallet->getBankName();
        $dto->bankNumber = $wallet->getBankNumber();
        $dto->street = $wallet->getStreet();
        $dto->zipCode = $wallet->getZipCode();
        $dto->city = $wallet->getCity();
        $dto->lastUpdate = $wallet->getUpdatedAt()->format('Y-m-d H:i');
        $dto->earnMoney = $wallet->getEarnMoney();

        return $dto;
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

    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    public function getEarMoney(): float
    {
        return $this->earnMoney;
    }
}
