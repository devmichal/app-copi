<?php

namespace App\Core\Domain\Model\Users\GS;

use App\Core\Domain\Model\Wallet\Wallet;
use Doctrine\Common\Collections\Collection;

trait UserGS
{
    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getTasks(): ?Collection
    {
        return $this->tasks;
    }

    public function getClient(): ?Collection
    {
        return $this->client;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    public function getCodeAuth(): string
    {
        return $this->codeAuth;
    }

    public function getDateAuthAt(): \DateTime
    {
        return $this->dateAuthAt;
    }

    public function getChangePassword(): ?\DateTime
    {
        return $this->changePasswordAt;
    }
}
