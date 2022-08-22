<?php

namespace App\Core\Application\Command\TypeText\DeleteTypeText;

final class DeleteTypeTextCommand
{
    public const NAME = 'delete.text';

    private string $typeText;

    public function __construct(
        string $typeText
    ) {
        $this->typeText = $typeText;
    }

    public function getTypeText(): string
    {
        return $this->typeText;
    }
}
