<?php

namespace App\Core\Application\Command\TypeText\UpdateTypeText;

use App\Core\Application\Command\TypeText\CreateTypeTextDTO;

final class UpdateTypeTexCommand
{
    public const NAME = 'update.text';

    private CreateTypeTextDTO $createTypeTextDTO;

    private string $idTextType;

    public function __construct(
        CreateTypeTextDTO $createTypeTextDTO,
        string $idTextType
    ) {
        $this->createTypeTextDTO = $createTypeTextDTO;
        $this->idTextType = $idTextType;
    }

    public function getCreateTypeTextDTO(): CreateTypeTextDTO
    {
        return $this->createTypeTextDTO;
    }

    public function getIdTextType(): string
    {
        return $this->idTextType;
    }
}
