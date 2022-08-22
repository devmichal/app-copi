<?php

namespace App\Core\Domain\Model\Client\GS;

use App\Core\Domain\Model\Users\User;
use Doctrine\Common\Collections\Collection;

trait ClientGS
{
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getNumberHouse(): string
    {
        return $this->numberHouse;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTask(): Collection
    {
        return $this->task;
    }

    public function getSalary(): float
    {
        if (!$this->salary) {
            return 0.0;
        }

        return $this->salary;
    }

    public function isGross(): bool
    {
        return $this->gross;
    }
}
