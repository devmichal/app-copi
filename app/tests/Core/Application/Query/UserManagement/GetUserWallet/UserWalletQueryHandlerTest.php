<?php

namespace App\Tests\Core\Application\Query\UserManagement\GetUserWallet;

use App\Core\Application\Query\UserManagement\GetUserWallet\UserWalletQuery;
use App\Core\Application\Query\UserManagement\GetUserWallet\UserWalletQueryHandler;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\Wallet;
use PHPUnit\Framework\TestCase;

class UserWalletQueryHandlerTest extends TestCase
{
    public const CITY = 'someCity';
    public const EARN_MONEY = 12.3;
    public const BANK_NUMBER = '1234567890';
    public const BANK_NAME = 'my-bank';
    public const STREET = 'street';

    private UserWalletQueryHandler $userWalletQueryHandler;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    /** @var Wallet|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $wallet;

    protected function setUp(): void
    {
        $this->user = $this->createMock(User::class);
        $this->wallet = $this->createMock(Wallet::class);

        $this->createWallet();

        $this->userWalletQueryHandler = new UserWalletQueryHandler();
    }

    public function testShouldReturnUserWallet()
    {
        $this->user
             ->method('getWallet')
             ->willReturn($this->wallet);

        $command = new UserWalletQuery($this->user);
        $handler = new UserWalletQueryHandler();
        $result = $handler($command);

        $this->assertEquals(self::CITY, $result->getCity());
        $this->assertEquals(self::BANK_NUMBER, $result->getBankNumber());
        $this->assertEquals(self::BANK_NAME, $result->getBankName());
        $this->assertEquals(self::STREET, $result->getStreet());
    }

    private function createWallet()
    {
        $this->wallet
             ->method('getStreet')
             ->willReturn(self::STREET);

        $this->wallet
            ->method('getBankNumber')
            ->willReturn(self::BANK_NUMBER);

        $this->wallet
            ->method('getCity')
            ->willReturn(self::CITY);

        $this->wallet
            ->method('getBankName')
            ->willReturn(self::BANK_NAME);
    }
}
