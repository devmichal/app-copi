<?php

namespace App\Shared\Infrastructure\ValueObject;

final class TallyTask
{
    private array $getClient;

    private array $getTypeText;


    public function __construct(
        array $getClient,
        array $getTypeText
    )
    {
        $this->getClient = $getClient;
        $this->getTypeText = $getTypeText;
    }

    /**
     * @return array
     */
    public function getGetClient(): array
    {
        return $this->getClient;
    }

    /**
     * @return array
     */
    public function getGetTypeText(): array
    {
        return $this->getTypeText;
    }
}