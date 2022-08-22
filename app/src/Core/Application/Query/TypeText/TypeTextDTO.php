<?php

namespace App\Core\Application\Query\TypeText;

use App\Core\Domain\Model\TypeText\TypeText;

final class TypeTextDTO
{
    private string $id;

    private string $destination;

    private string $createdAt;

    public static function fromEntity(TypeText $typeText): TypeTextDTO
    {
        $dto = new self();

        $dto->id = $typeText->getId();
        $dto->destination = $typeText->getDestination();
        $dto->createdAt = $typeText->getCreatedAt()->format('Y-m-d H:i');

        return $dto;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
