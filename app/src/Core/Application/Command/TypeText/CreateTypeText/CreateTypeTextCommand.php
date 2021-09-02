<?php


namespace App\Core\Application\Command\TypeText\CreateTypeText;


use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Domain\Model\Users\User;


final class CreateTypeTextCommand
{
    public const NAME = 'create.text';


    private CreateTypeTextDTO $createTypeTextDTO;

    private User $user;


    public function __construct(
        CreateTypeTextDTO $createTypeTextDTO,
        User $user
    )
    {
        $this->createTypeTextDTO = $createTypeTextDTO;
        $this->user = $user;
    }

    /**
     * @return CreateTypeTextDTO
     */
    public function getCreateTypeTextDTO(): CreateTypeTextDTO
    {
        return $this->createTypeTextDTO;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}