<?php


namespace App\Core\Application\Query\Task;


use App\Core\Domain\Model\Task\Task;
use App\Shared\Domain\Enum\FormatDate;


final class TaskDTO
{
    private string $id;

    private string $titleTask;

    private int $status;

    private string $createdAt;

    private string $deadLine;

    private ?string $client = null;

    private ?string $clientId = null;

    private int $numberCountCharacter;

    private ?string $typeText = null;

    private ?string $typeTextId = null;

    private float $walletTask;


    public static function fromEntity(Task $task): TaskDTO
    {
        $client   = $task->getClient();
        $typeText = $task->getTypeText();

        $dto = new self();

        $dto->id                   = $task->getId();
        $dto->titleTask            = $task->getTitleTask();
        $dto->status               = $task->getStatus();
        $dto->numberCountCharacter = $task->getNumberCountCharacter();
        $dto->createdAt            = $task->getTaskDate()->getCreateAt()->format(FormatDate::Y_M_D);
        $dto->deadLine             = $task->getTaskDate()->getDeadLineAt()->format(FormatDate::Y_M_D);
        $dto->client               = $client->getName();
        $dto->clientId             = $client->getId();
        $dto->typeTextId           = $typeText ? $typeText->getId() : null;
        $dto->typeText             = $typeText ? $typeText->getDestination() : null;
        $dto->walletTask           = $task->getWalletTask()->getMoney();

        return $dto;
    }

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
    public function getTitleTask(): string
    {
        return $this->titleTask;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getDeadLine(): string
    {
        return $this->deadLine;
    }

    /**
     * @return string|null
     */
    public function getClient(): ?string
    {
        return $this->client;
    }

    /**
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @return int
     */
    public function getNumberCountCharacter(): int
    {
        return $this->numberCountCharacter;
    }

    /**
     * @return string|null
     */
    public function getTypeText(): ?string
    {
        return $this->typeText;
    }

    /**
     * @return string|null
     */
    public function getTypeTextId(): ?string
    {
        return $this->typeTextId;
    }

    /**
     * @return float
     */
    public function getWalletTask(): float
    {
        return $this->walletTask;
    }
}