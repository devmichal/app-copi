<?php


namespace App\Core\Domain\Model\Users\GS;


use App\Core\Domain\Model\File\Files;
use App\Core\Domain\Model\Users\UsersAuth;
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

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return Collection|null
     */
    public function getTasks(): ?Collection
    {
        return $this->tasks;
    }

    /**
     * @return Collection|null
     */
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

    /**
     * @return Wallet
     */
    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    /**
     * @return string
     */
    public function getCodeAuth(): string
    {
        return $this->codeAuth;
    }

    /**
     * @return \DateTime
     */
    public function getDateAuthAt(): \DateTime
    {
        return $this->dateAuthAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getChangePassword(): ?\DateTime
    {
        return $this->changePasswordAt;
    }
}
