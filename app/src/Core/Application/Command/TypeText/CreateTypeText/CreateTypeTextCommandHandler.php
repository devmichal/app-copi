<?php


namespace App\Core\Application\Command\TypeText\CreateTypeText;


use App\Core\Domain\Model\TypeText\TypeText;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class CreateTypeTextCommandHandler implements EventSubscriberInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return[
          CreateTypeTextCommand::NAME => 'createText'
        ];
    }

    public function createText(CreateTypeTextCommand $createTypeTextCommand): void
    {
        $createTypeTextDTO = $createTypeTextCommand->getCreateTypeTextDTO();
        $user              = $createTypeTextCommand->getUser();

        $typeText = new TypeText();
        $typeText->handlerDTO($createTypeTextDTO);
        $typeText->handlerUser($user);

        $this->entityManager->persist($typeText);
        $this->entityManager->flush();
    }
}