<?php


namespace App\Core\Application\Command\TypeText;


final class CreateTypeTextDTO
{
    private string $destination;

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination(string $destination): void
    {
        $this->destination = $destination;
    }
}