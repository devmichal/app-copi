<?php


namespace App\Core\Application\Command\Client\DeleteClient;


final class DeleteClientCommand
{
    public const NAME = 'delete.client';


    private string $clientId;

    public function __construct(
        string $clientId
    )
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }
}