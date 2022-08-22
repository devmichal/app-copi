<?php

namespace App\Shared\Infrastructure\ValueObject;

final class FilterCreatedAtTask
{
    private string $client;

    private ?string $startCreatedAt;

    private ?string $finishCreatedAt;

    public function __construct(
        string $client,
        ?string $startCreatedAt,
        ?string $finishCreatedAt
    ) {
        $this->client = $client;
        $this->startCreatedAt = 'null' !== $startCreatedAt ? $startCreatedAt : null;
        $this->finishCreatedAt = 'null' !== $finishCreatedAt ? $finishCreatedAt : null;
    }

    public function getClient(): string
    {
        return $this->client;
    }

    public function getStartCreatedAt(): ?string
    {
        return $this->startCreatedAt;
    }

    public function getFinishCreatedAt(): ?string
    {
        return $this->finishCreatedAt;
    }
}
