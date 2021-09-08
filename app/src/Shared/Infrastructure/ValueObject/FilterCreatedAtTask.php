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
    )
    {
        $this->client          = $client;
        $this->startCreatedAt  = $startCreatedAt !== 'null' ? $startCreatedAt : null;
        $this->finishCreatedAt = $finishCreatedAt !== 'null' ? $finishCreatedAt : null;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @return string|null
     */
    public function getStartCreatedAt(): ?string
    {
        return $this->startCreatedAt;
    }

    /**
     * @return string|null
     */
    public function getFinishCreatedAt(): ?string
    {
        return $this->finishCreatedAt;
    }
}