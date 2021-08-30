<?php


namespace App\Core\Domain\Model\TypeText;


use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Domain\Model\TypeText\GS\TypeTextGS;
use App\Core\Domain\Model\Users\User;
use Doctrine\Common\Collections\ArrayCollection;

class TypeText
{
    use TypeTextGS;

    /** @var string */
    private $id;

    /** @var string */
    private $destination;

    /** @var \DateTime */
    private $createdAt;

    /** @var ArrayCollection */
    private $task;

    /** @var User */
    private $user;

    public function __construct()
    {
        $this->id        = uuid_create();
        $this->createdAt = new \DateTime();
    }

    public function handlerDTO(
        CreateTypeTextDTO $createTypeTextDTO
    )
    {
        $this->destination = $createTypeTextDTO->getDestination();
    }

    public function handlerUser(
        User $user
    )
    {
        $this->user = $user;
    }
}
