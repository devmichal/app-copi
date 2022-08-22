<?php

namespace App\Core\Domain\Model\TypeText;

use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Domain\Model\TypeText\GS\TypeTextGS;
use App\Core\Domain\Model\Users\User;
use DateTime;
use Doctrine\Common\Collections\Collection;

class TypeText
{
    use TypeTextGS;

    private string $id;

    private string $destination;

    private DateTime $createdAt;

    private Collection $task;

    private User $user;

    public function __construct()
    {
        $this->id = uuid_create();
        $this->createdAt = new \DateTime();
    }

    final public function handlerDTO(
        CreateTypeTextDTO $createTypeTextDTO
    ): void {
        $this->destination = $createTypeTextDTO->getDestination();
    }

    final public function handlerUser(
        User $user
    ): void {
        $this->user = $user;
    }
}
