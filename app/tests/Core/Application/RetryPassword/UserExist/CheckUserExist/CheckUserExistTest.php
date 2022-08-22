<?php

namespace App\Tests\Core\Application\RetryPassword\UserExist\CheckUserExist;

use App\Core\Application\RetryPassword\UserExist\CheckUserExist\CreateResetTokenPassword;
use App\Core\Application\RetryPassword\UserExist\SendTokenPasswordDTO;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Notification\NotificationEmil;
use App\Core\Infrastructure\Repository\Users\MatchUser;
use App\Core\Infrastructure\Security\ResetPassword\CreateResetToken\CreateResetTokenInterface;
use App\Shared\Domain\Exception\InvalidUser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CheckUserExistTest extends TestCase
{
    public const USER_EMAIL = 'some.email@gmail.com';

    private CreateResetTokenPassword $checkUserExist;

    /** @var MatchUser|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $matchUser;

    /** @var MessageBusInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $messageBus;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $users;

    /** @var CreateResetTokenInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $createResetToken;

    /** @var mixed|\PHPUnit\Framework\MockObject\MockObject|EventDispatcherInterface */
    private $eventDispatcher;

    protected function setUp(): void
    {
        $this->matchUser = $this->createMock(MatchUser::class);
        $this->messageBus = $this->createMock(MessageBusInterface::class);
        $this->users = $this->createMock(User::class);
        $this->createResetToken = $this->createMock(CreateResetTokenInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $this->checkUserExist = new CreateResetTokenPassword(
            $this->matchUser,
            $this->createResetToken,
            $this->messageBus,
            $this->eventDispatcher
        );
    }

    public function testShouldReturnExceptionUserNotExist()
    {
        $this->expectException(InvalidUser::class);

        $this->matchUser
             ->method('getUser')
             ->willReturn(null);

        $this->checkUserExist->sendEmail($this->createUserDTO());
    }

    /*  public function testShouldSendEmailCorrectEmail()
      {
          $userExistDTO = $this->createUserDTO();

          $this->matchUser
              ->method('getUser')
              ->willReturn($this->users);

          $this->users
               ->method('getEmail')
               ->willReturn(self::USER_EMAIL);

          $this->messageBus->expects(self::once())
              ->method('send')
              ->with(self::callback(fn(NotificationEmil $notificationEmil): bool =>
                  $notificationEmil->getRecipientEmail() === $userExistDTO->getUser()
              ));

          $this->checkUserExist->sendEmail($userExistDTO);
      }*/

    private function createUserDTO(): SendTokenPasswordDTO
    {
        $userDTO = new SendTokenPasswordDTO();
        $userDTO->setUser(self::USER_EMAIL);

        return $userDTO;
    }
}
