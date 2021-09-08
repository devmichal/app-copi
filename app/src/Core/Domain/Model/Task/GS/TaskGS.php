<?php


namespace App\Core\Domain\Model\Task\GS;


use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\File\Files;
use App\Core\Domain\Model\Task\TaskDate;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\WalletTask;

trait TaskGS
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
    public function getTitleTask(): string
    {
        return $this->titleTask;
    }

    /**
     * @return TaskDate
     */
    public function getTaskDate(): TaskDate
    {
        return $this->taskDate;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return TypeText|null
     */
    public function getTypeText(): ?TypeText
    {
        return $this->typeText;
    }

    /**
     * @return int
     */
    public function getNumberCountCharacter(): int
    {
        return $this->numberCountCharacter;
    }

    /**
     * @return User
     */
    public function getUsers(): User
    {
        return $this->users;
    }

    /**
     * @return Files
     */
    public function getFiles(): Files
    {
        return $this->files;
    }

    /**
     * @return WalletTask
     */
    public function getWalletTask(): WalletTask
    {
        return $this->walletTask;
    }
}
