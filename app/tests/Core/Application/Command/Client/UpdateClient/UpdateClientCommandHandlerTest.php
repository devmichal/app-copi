<?php

namespace App\Tests\Core\Application\Command\Client\UpdateClient;

use App\Core\Application\Command\Client\UpdateClient\UpdateClientCommand;
use App\Core\Application\Command\Client\UpdateClient\UpdateClientCommandHandler;
use App\Core\Domain\Model\Client\Client;
use App\Core\Infrastructure\Repository\Client\ClientRepositoryInterface;
use App\Core\Infrastructure\Repository\Client\MatchClientInterface;
use App\Tests\Core\Application\Command\Client\CreateClientDTOTest;
use PHPUnit\Framework\TestCase;

class UpdateClientCommandHandlerTest extends TestCase
{
    private UpdateClientCommandHandler $updateClientCommandHandler;

    /** @var ClientRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $clientRepository;

    /** @var MatchClientInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $matchClientInterface;

    protected function setUp(): void
    {
        $this->matchClientInterface = $this->createMock(MatchClientInterface::class);
        $this->clientRepository = $this->createMock(ClientRepositoryInterface::class);

        $this->updateClientCommandHandler = new UpdateClientCommandHandler(
            $this->matchClientInterface,
            $this->clientRepository
        );
    }

    public function testShouldUpdateClient()
    {
        $updateClientCommand = $this->updateClientCommand();

        $this->matchClientInterface
             ->method('foundClient')
             ->willReturn(new Client());

        $this->clientRepository->expects(self::once())
             ->method('add')
             ->with(self::callback(fn (Client $client): bool => $client->getName() === $updateClientCommand->getCreateClientDTO()->getName() &&
                $client->getCity() === $updateClientCommand->getCreateClientDTO()->getCity() &&
                $client->getSalary() === $updateClientCommand->getCreateClientDTO()->getSalary()
             ));

        $this->updateClientCommandHandler->updateClient($updateClientCommand);
    }

    private function updateClientCommand(): UpdateClientCommand
    {
        return new UpdateClientCommand(
            CreateClientDTOTest::createClient(),
            'some client id'
        );
    }
}
