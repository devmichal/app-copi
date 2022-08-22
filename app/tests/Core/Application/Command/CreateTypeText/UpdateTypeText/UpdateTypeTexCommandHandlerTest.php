<?php

namespace App\Tests\Core\Application\Command\CreateTypeText\UpdateTypeText;

use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Application\Command\TypeText\UpdateTypeText\UpdateTypeTexCommand;
use App\Core\Application\Command\TypeText\UpdateTypeText\UpdateTypeTexCommandHandler;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Infrastructure\Repository\TypeText\FindByOneTypeText;
use App\Shared\Domain\Exception\EmptyTypeText;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UpdateTypeTexCommandHandlerTest extends TestCase
{
    /** @var UpdateTypeTexCommandHandler */
    private $updateTypeTexCommandHandler;

    /** @var EntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var FindByOneTypeText|\PHPUnit\Framework\MockObject\MockObject */
    private $findByOneTypeText;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->findByOneTypeText = $this->createMock(FindByOneTypeText::class);

        $this->updateTypeTexCommandHandler = new UpdateTypeTexCommandHandler(
            $this->entityManager,
            $this->findByOneTypeText
        );
    }

    public function testShouldReturnExceptionNoFoundTypeText()
    {
        $this->expectException(EmptyTypeText::class);

        $this->updateTypeTexCommandHandler->updateText($this->typeTexCommand());
    }

    public function testShouldUpdateTypeText()
    {
        $this->findByOneTypeText
             ->method('findByOneText')
             ->willReturn(new TypeText());

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with(self::callback(fn (TypeText $typeText): bool => $typeText->getDestination() === $this->typeTexCommand()->getCreateTypeTextDTO()->getDestination()
            ));

        $this->updateTypeTexCommandHandler->updateText($this->typeTexCommand());
    }

    private function typeTexCommand(): UpdateTypeTexCommand
    {
        $createTypeTextDTO = new CreateTypeTextDTO();
        $createTypeTextDTO->setDestination('some some');

        return new UpdateTypeTexCommand($createTypeTextDTO, 'some id');
    }
}
