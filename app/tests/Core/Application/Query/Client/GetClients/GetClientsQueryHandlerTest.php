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
    public const PAYMENT_ONE = 12.1;
    public const PAYMENT_TWO = 41.2;

    /** @var UserClients|\PHPUnit\Framework\MockObject\MockObject */
    private $userClients;

    /** @var Client|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $clientOne;

    /** @var Client|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $clientTwo;

    protected function setUp(): void
    {
        $this->clientOne = $this->createMock(Client::class);
        $this->clientTwo = $this->createMock(Client::class);

        $this->userClients = $this->createMock(UserClients::class);
    }

    final public function testShouldReturnFullyPaginationData(): void
    {
        $this->userClients
             ->method('getClients')
             ->willReturn($this->userClients());

        $command = new GetClientsQuery(new User());
        $handler = new GetClientsQueryHandler($this->userClients);
        $result = $handler($command);

        $this->assertInstanceOf(ClientDTO::class, $result[0]);
        $this->assertCount(2, $result);
        $this->assertFalse($result[0]->isGross());
        $this->assertEquals(self::PAYMENT_ONE, $result[0]->getSalary());
        $this->assertEquals(self::PAYMENT_TWO, $result[1]->getSalary());
    }

    private function userClients(): array
    {
        $clientOne = $this->clientOne;
        $clientOne
            ->method('getSalary')
            ->willReturn(self::PAYMENT_ONE);

        $clientTwo = $this->clientTwo;
        $clientTwo
            ->method('getSalary')
            ->willReturn(self::PAYMENT_TWO);

        $clientOne->handler(CreateClientDTOTest::createClient(), );
        $clientTwo->handler(CreateClientDTOTest::createClient(), );

        return [$clientOne, $clientTwo];
    }
}
