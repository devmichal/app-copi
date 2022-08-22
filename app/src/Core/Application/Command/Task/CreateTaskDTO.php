<?php

namespace App\Core\Application\Command\Task;

use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\TypeText\TypeText;

final class CreateTaskDTO
{
    private string $titleTask;

    private ?string $createdAt = null;

    private ?string $deadLineAt = null;

    private ?Client $client = null;

    private ?TypeText $typeText = null;

    private int $numberCountCharacter;

    private bool $status = false;

    public function getTitleTask(): string
    {
        return $this->titleTask;
    }

    public function setTitleTask(string $titleTask): void
    {
        $this->titleTask = $titleTask;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getDeadLineAt(): ?string
    {
        return $this->deadLineAt;
    }

    public function setDeadLineAt(?string $deadLineAt): void
    {
        $this->deadLineAt = $deadLineAt;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }

    public function getTypeText(): ?TypeText
    {
        return $this->typeText;
    }

    public function setTypeText(?TypeText $typeText): void
    {
        $this->typeText = $typeText;
    }

    public function getNumberCountCharacter(): int
    {
        return $this->numberCountCharacter;
    }

    public function setNumberCountCharacter(int $numberCountCharacter): void
    {
        $this->numberCountCharacter = $numberCountCharacter;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
