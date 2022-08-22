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

    public function getTitleTask(): string
    {
        return $this->titleTask;
    }

    public function getTaskDate(): TaskDate
    {
        return $this->taskDate;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getTypeText(): ?TypeText
    {
        return $this->typeText;
    }

    public function getNumberCountCharacter(): int
    {
        return $this->numberCountCharacter;
    }

    public function getUsers(): User
    {
        return $this->users;
    }

    public function getFiles(): Files
    {
        return $this->files;
    }

    public function getWalletTask(): WalletTask
    {
        return $this->walletTask;
    }
}
