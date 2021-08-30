<?php


namespace App\Core\Application\Command\Task;


use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\TypeText\TypeText;


final class CreateTaskDTO
{
    private string $titleTask;

    private string $deadLineAt;

    private ?Client $client = null;

    private ?TypeText $typeText = null;

    private int $numberCountCharacter;

    private bool $status = false;


    /**
     * @return string
     */
    public function getTitleTask(): string
    {
        return $this->titleTask;
    }

    /**
     * @param string $titleTask
     */
    public function setTitleTask(string $titleTask): void
    {
        $this->titleTask = $titleTask;
    }

    /**
     * @return string
     */
    public function getDeadLineAt(): string
    {
        return $this->deadLineAt;
    }

    /**
     * @param string $deadLineAt
     */
    public function setDeadLineAt(string $deadLineAt): void
    {
        $this->deadLineAt = $deadLineAt;
    }

    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client|null $client
     */
    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return TypeText|null
     */
    public function getTypeText(): ?TypeText
    {
        return $this->typeText;
    }

    /**
     * @param TypeText|null $typeText
     */
    public function setTypeText(?TypeText $typeText): void
    {
        $this->typeText = $typeText;
    }

    /**
     * @return int
     */
    public function getNumberCountCharacter(): int
    {
        return $this->numberCountCharacter;
    }

    /**
     * @param int $numberCountCharacter
     */
    public function setNumberCountCharacter(int $numberCountCharacter): void
    {
        $this->numberCountCharacter = $numberCountCharacter;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}