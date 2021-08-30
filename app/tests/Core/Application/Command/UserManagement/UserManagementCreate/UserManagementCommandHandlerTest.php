<?php

namespace App\Tests\Core\Application\Command\UserManagement\UserManagementCreate;


use App\Core\Application\Command\UserManagement\UserManagementCreate;
use App\Core\Application\Command\UserManagement\UserManagementCreate\UserManagementCommand;
use App\Core\Application\Command\UserManagement\UserManagementCreate\UserManagementCommandHandler;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\Wallet;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UserManagementCommandHandlerTest extends TestCase
{
    /** @var EntityManagerInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var UserManagementCommandHandler  */
    private UserManagementCommandHandler $userManagementCommandHandler;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $users;

    protected function setUp(): void
    {
        $this->users         = $this->createMock(User::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->userManagementCommandHandler = new UserManagementCommandHandler(
            $this->entityManager
        );
    }

    public function testShouldReturnUpdatedWalletOfUser()
    {
        $walletDTO = $this->createTaskCommand();

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with(self::callback(fn(Wallet $wallet): bool =>
                $wallet->getBankNumber() === $walletDTO->getManagementCreate()->getBankNumber() &&
                $wallet->getBankName()   === $walletDTO->getManagementCreate()->getBankName()
            ));

        $this->userManagementCommandHandler->userWallet($walletDTO);
    }

    private function createTaskCommand(): UserManagementCommand
    {
        $this->users
             ->method('getWallet')
             ->willReturn(new Wallet());

        $managementCreate = new UserManagementCreate();
        $managementCreate->setBankName('my bank');
        $managementCreate->setBankNumber('12345678901234567890123456');
        $managementCreate->setCity('some city');
        $managementCreate->setStreet('street');
        $managementCreate->setZipCode('12-312');

        return new UserManagementCommand(
            $this->users,
            $managementCreate
        );
    }

}