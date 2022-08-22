<?php

namespace App\Shared\Infrastructure\ValueObject;

final class TallyTask
{
    private array $getClient;

    private array $getTypeText;

    public function __construct(
        array $getClient,
        array $getTypeText
    ) {
        $this->getClient = $getClient;
        $this->getTypeText = $getTypeText;
    }

    public function getGetClient(): array
    {
        return $this->getClient;
    }

    public function getGetTypeText(): array
    {
        return $this->getTypeText;
    }
}
