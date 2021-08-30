<?php

namespace App\Tests\Core\Application\Command\User\BlockUserAccount;


use App\Core\Application\Command\User\BlockUserAccount\BlockUserCommand;
use App\Core\Application\Command\User\BlockUserAccount\BlockUserCommandHandler;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\Users\MatchUser;
use App\Shared\Domain\Exception\InvalidUser;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class BlockUserCommandHandlerTest extends TestCase
{
    /** @var MatchUser|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $matchUser;

    /** @var EntityManagerInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $entityManager;

    /** @var BlockUserCommandHandler  */
    private BlockUserCommandHandler $blockUserCommandHandler;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    protected function setUp(): void
    {
        $this->matchUser     = $this->createMock(MatchUser::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->user          = $this->createMock(User::class);

        $this->blockUserCommandHandler = new BlockUserCommandHandler(
            $this->matchUser,
            $this->entityManager
        );
    }

    public function testShouldReturnExceptionUserDoesExist()
    {
        $this->expectException(InvalidUser::class);

        $this->blockUserCommandHandler->disableAccount($this->createBlockUserCommand());
    }

    public function testSoldDisableUserAccountAntiBrutForce()
    {
        $this->matchUser
             ->method('getUser')
             ->willReturn($this->user);

        $this->entityManager->expects(self::once())
            ->method('persist')
            ->with(self::callback(fn(User $user): bool =>
                $user->isEnabled() === false
            ));

        $this->blockUserCommandHandler->disableAccount($this->createBlockUserCommand());
    }

    private function createBlockUserCommand(): BlockUserCommand
    {
        return new BlockUserCommand('someUsername');
    }

}