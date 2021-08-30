<?php


namespace App\Core\Domain\Model\Client\GS;


use App\Core\Domain\Model\Users\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait ClientGS
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getNumberHouse(): string
    {
        return $this->numberHouse;
    }

    /**
     * @return null|string
     */
    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Collection
     */
    public function getTask(): Collection
    {
        return $this->task;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        if (!$this->salary) {

            return 0.0;
        }
        return $this->salary;
    }

    /**
     * @return bool
     */
    public function isGross(): bool
    {
        return $this->gross;
    }
}
