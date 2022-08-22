<?php

namespace App\Core\Application\Command\TypeText;

final class CreateTypeTextDTO
{
    private string $destination;

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): void
    {
        $this->destination = $destination;
    }
}
