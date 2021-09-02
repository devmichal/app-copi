<?php


namespace App\Core\Application\Command\TypeText\UpdateTypeText;


use App\Core\Application\Command\TypeText\CreateTypeTextDTO;


final class UpdateTypeTexCommand
{
    public const NAME = 'update.text';


    private CreateTypeTextDTO $createTypeTextDTO;

    private string $idTextType;


    public function __construct(
        CreateTypeTextDTO $createTypeTextDTO,
        string $idTextType
    )
    {
        $this->createTypeTextDTO = $createTypeTextDTO;
        $this->idTextType = $idTextType;
    }

    /**
     * @return CreateTypeTextDTO
     */
    public function getCreateTypeTextDTO(): CreateTypeTextDTO
    {
        return $this->createTypeTextDTO;
    }

    /**
     * @return string
     */
    public function getIdTextType(): string
    {
        return $this->idTextType;
    }
}