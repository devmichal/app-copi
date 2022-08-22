<?php

namespace App\Core\Application\Command\TypeText\UpdateTypeText;

use App\Core\Infrastructure\Repository\TypeText\FindByOneTypeText;
use App\Shared\Domain\Exception\EmptyTypeText;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class UpdateTypeTexCommandHandler implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;

    private FindByOneTypeText $findByOneTypeText;

    public function __construct(
        EntityManagerInterface $entityManager,
        FindByOneTypeText $findByOneTypeText
    ) {
        $this->entityManager = $entityManager;
        $this->findByOneTypeText = $findByOneTypeText;
    }

    public static function getSubscribedEvents(): array
    {
        return [
          UpdateTypeTexCommand::NAME => 'updateText',
        ];
    }

    /**
     * @throws EmptyTypeText
     */
    public function updateText(UpdateTypeTexCommand $typeTexCommand): void
    {
        $createTypeTextDTO = $typeTexCommand->getCreateTypeTextDTO();
        $typeText = $this->findByOneTypeText->findByOneText($typeTexCommand->getIdTextType());

        if (!$typeText) {
            throw new EmptyTypeText('No found type text');
        }

        $typeText->handlerDTO($createTypeTextDTO);

        $this->entityManager->persist($typeText);
        $this->entityManager->flush();
    }
}
