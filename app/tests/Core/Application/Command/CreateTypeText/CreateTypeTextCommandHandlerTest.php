<?php


namespace App\Tests\Core\Application\Command\CreateTypeText;


use App\Core\Application\Command\TypeText\CreateTypeText\CreateTypeTextCommand;
use App\Core\Application\Command\TypeText\CreateTypeText\CreateTypeTextCommandHandler;
use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CreateTypeTextCommandHandlerTest extends TestCase
{
    /** @var EntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var CreateTypeTextCommandHandler */
    private $createTypeTextCommandHandler;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->createTypeTextCommandHandler = new CreateTypeTextCommandHandler(
            $this->entityManager
        );
    }

    public function testShouldCreateTypeTextForUsers()
    {
        $createTypeTextDTO = $this->textCommand();

        $this->entityManager->expects(self::once())
             ->method('persist')
             ->with(self::callback(fn(TypeText $typeText): bool =>
                  $typeText->getDestination() === $createTypeTextDTO->getCreateTypeTextDTO()->getDestination()
             ));

        $this->createTypeTextCommandHandler->createText($createTypeTextDTO);
    }

    private function textCommand(): CreateTypeTextCommand
    {
        $createTypeTextDTO = new CreateTypeTextDTO();
        $createTypeTextDTO->setDestination('some destination');

        return new CreateTypeTextCommand($createTypeTextDTO, new User());
    }

}