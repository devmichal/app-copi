<?php

namespace App\Tests\Core\Infrastructure\Security\ResetPassword;

use App\Core\Application\RetryPassword\UserExist\CheckUserExist\CreateResetTokenPasswordInterface;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Security\ResetPassword\AntiBrutForceToken\AntiBrutForceTokenInterface;
use App\Core\Infrastructure\Security\ResetPassword\TimeToLiveToken\TimeToLiveTokenInterface;
use App\Core\Infrastructure\Security\ResetPassword\ValidateTokenResetPassword;
use App\Core\Infrastructure\Security\ResetPassword\VerifyTokenPassword\VerifyTokenPasswordInterface;
use App\Shared\Domain\Exception\InvalidResetToken;
use PHPUnit\Framework\TestCase;

class ValidateTokenResetPasswordTest extends TestCase
{
    public const USER_TOKEN = '3123412';

    /** @var AntiBrutForceTokenInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $antiBrutForceToken;

    /** @var TimeToLiveTokenInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $timeToLiveToken;

    /** @var VerifyTokenPasswordInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $verifyTokenPassword;

    /** @var CreateResetTokenPasswordInterface|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $resetTokenPassword;

    private ValidateTokenResetPassword $validateTokenResetPassword;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    protected function setUp(): void
    {
        $this->antiBrutForceToken = $this->createMock(AntiBrutForceTokenInterface::class);
        $this->timeToLiveToken = $this->createMock(TimeToLiveTokenInterface::class);
        $this->verifyTokenPassword = $this->createMock(VerifyTokenPasswordInterface::class);
        $this->resetTokenPassword = $this->createMock(CreateResetTokenPasswordInterface::class);
        $this->user = $this->createMock(User::class);
        $this->prepareUsers();

        $this->validateTokenResetPassword = new ValidateTokenResetPassword(
            $this->antiBrutForceToken,
            $this->timeToLiveToken,
            $this->verifyTokenPassword,
            $this->resetTokenPassword
        );
    }

    public function testShouldReturnExceptionTokenExpiration()
    {
        $this->expectException(InvalidResetToken::class);
        $this->expectExceptionMessage('Token expired');

        $this->timeToLiveToken
             ->method('isExpirationToken')
             ->willReturn(true);

        $this->validateTokenResetPassword->tokenIsValid($this->user, self::USER_TOKEN);
    }

    public function testShouldReturnExceptionTooManyIncorrectTokens()
    {
        $this->expectException(InvalidResetToken::class);
        $this->expectExceptionMessage('To many Incorrect tokens');

        $this->antiBrutForceToken
            ->method('isToMoneyWrongToken')
            ->willReturn(true);

        $this->validateTokenResetPassword->tokenIsValid($this->user, self::USER_TOKEN);
    }

    private function prepareUsers()
    {
        $date = new \DateTime();

        $this->user
            ->method('getEmail')
            ->willReturn('some.email@gmail.com');

        $this->user
            ->method('getDateAuthAt')
            ->willReturn($date);

        $this->user
            ->method('getCodeAuth')
            ->willReturn('someCode');

        $this->user
            ->method('getId')
            ->willReturn('someCode');
    }
}
