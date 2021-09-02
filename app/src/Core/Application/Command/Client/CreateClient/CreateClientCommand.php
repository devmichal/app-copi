<?php


namespace App\Core\Application\Command\Client\CreateClient;


use App\Core\Application\Command\Client\CreateClientDTO;
use App\Core\Domain\Model\Users\User;

final class CreateClientCommand
{
    public const NAME = 'create.client';


    private User $user;

    private CreateClientDTO $createClientDTO;


    public function __construct(
        CreateClientDTO $clientDTO,
        User $user
    )
    {
        $this->user            = $user;
        $this->createClientDTO = $clientDTO;
    }

    /**
     * @return CreateClientDTO
     */
    public function getCreateClientDTO(): CreateClientDTO
    {
        return $this->createClientDTO;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}