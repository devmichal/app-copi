<?php

namespace App\Core\Application\Query\Client;

use App\Core\Domain\Model\Client\Client;

final class ClientDTO
{
    private string $id;

    private string $name;

    private string $city;

    private string $street;

    private string $zipCode;

    private string $numberHouse;

    private ?string $taxNumber;

    private bool $gross;

    private float $salary;

    public static function fromEntity(Client $client): ClientDTO
    {
        $dto = new self();

        $dto->id = $client->getId();
        $dto->name = $client->getName();
        $dto->city = $client->getCity();
        $dto->salary = $client->getSalary();
        $dto->street = $client->getStreet();
        $dto->zipCode = $client->getZipCode();
        $dto->numberHouse = $client->getNumberHouse();
        $dto->taxNumber = $client->getTaxNumber();
        $dto->gross = $client->isGross();

        return $dto;
    }

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

    public function getSalary(): float
    {
        return $this->salary;
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

    public function isGross(): bool
    {
        return $this->gross;
    }
}
