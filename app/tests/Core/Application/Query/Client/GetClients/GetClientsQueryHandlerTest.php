<?php


namespace App\Tests\Core\Application\Query\Client\GetClients;


use App\Core\Application\Query\Client\ClientDTO;
use App\Core\Application\Query\Client\GetClients\GetClientsQuery;
use App\Core\Application\Query\Client\GetClients\GetClientsQueryHandler;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Client\UserClients;
use App\Tests\Core\Application\Command\Client\CreateClientDTOTest;
use PHPUnit\Framework\TestCase;

class GetClientsQueryHandlerTest extends TestCase
{
    /** @var UserClients|\PHPUnit\Framework\MockObject\MockObject */
    private $userClients;

    protected function setUp(): void
    {
        $this->userClients = $this->createMock(UserClients::class);
    }

    public function testShouldReturnFullyPaginationData()
    {
        $this->userClients
             ->method('getClients')
             ->willReturn($this->userClients());

        $command = new GetClientsQuery(new User());
        $handler = new GetClientsQueryHandler($this->userClients);
        $result = $handler($command);

        $this->assertInstanceOf(ClientDTO::class, $result[0]);
        $this->assertIsArray($result);
        $this->assertEquals(2, count($result));
        $this->assertFalse($result[0]->isGross());
        $this->assertEquals(12.1, $result[0]->getSalary());
    }

    private function userClients(): array
    {
        $clientOne = new Client();
        $clientTwo = new Client();

        $clientOne->handler(CreateClientDTOTest::createClient(),);
        $clientTwo->handler(CreateClientDTOTest::createClient(),);

        return [$clientOne, $clientTwo];
    }

}