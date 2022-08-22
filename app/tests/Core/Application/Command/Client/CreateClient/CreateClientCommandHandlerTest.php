<?php

namespace App\Tests\Core\Application\Command\Client\CreateClient;

use App\Core\Application\Command\Client\CreateClient\CreateClientCommand;
use App\Core\Application\Command\Client\CreateClient\CreateClientCommandHandler;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Client\ClientRepositoryInterface;
use App\Tests\Core\Application\Command\Client\CreateClientDTOTest;
use PHPUnit\Framework\TestCase;

class CreateClientCommandHandlerTest extends TestCase
{
    /** @var CreateClientCommandHandler */
    private $createClientCommandHandler;

    /** @var ClientRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $clientRepository;

    protected function setUp(): void
    {
        $this->clientRepository = $this->createMock(ClientRepositoryInterface::class);

        $this->createClientCommandHandler = new CreateClientCommandHandler(
            $this->clientRepository
        );
    }

    public function testShouldCreateClient()
    {
        $createClientCommand = $this->createClientCommand();
        $createClientDTO = $this->createClientCommand()->getCreateClientDTO();

        $this->clientRepository->expects(self::once())
             ->method('add')
             ->with(self::callback(fn (Client $client): bool => $client->getName() === $createClientDTO->getName() &&
                $client->getTaxNumber() === $createClientDTO->getTaxNumber() &&
                $client->getUser()->getId() === $createClientCommand->getUser()->getId() &&
                $client->getSalary() === $createClientDTO->getSalary()
             ));

        $this->createClientCommandHandler->createClient($createClientCommand);
    }

    private function createClientCommand(): CreateClientCommand
    {
        return new CreateClientCommand(
            CreateClientDTOTest::createClient(),
            new User()
        );
    }
}
