<?php

namespace App\Tests\Core\Infrastructure\Security\ResetPassword\VerifyTokenPassword;


use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\RedisRepository\Users\AddCacheTokenStatus;
use App\Core\Infrastructure\Security\ResetPassword\VerifyTokenPassword\VerifyTokenPassword;
use App\Shared\Domain\Exception\InvalidResetToken;
use PHPUnit\Framework\TestCase;

class VerifyTokenPasswordTest extends TestCase
{
    const HASH_USER_CORRECT  = '$argon2id$v=19$m=65536,t=4,p=1$UWd4Sms4cDVONHljaUtFMQ$F3ti1IcdJ1qReiwquuD1BX+DzgUU73GOIv/TWowEk7A';
    const TOKEN_USER_CORRECT = '';
    const INCORRECT_TOKEN    = '12312047';

    /** @var VerifyTokenPassword  */
    private VerifyTokenPassword $verifyTokenPassword;

    /** @var AddCacheTokenStatus|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $addCacheTokenStatus;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    protected function setUp(): void
    {
        $this->addCacheTokenStatus = $this->createMock(AddCacheTokenStatus::class);
        $this->user                = $this->createMock(User::class);

        $this->verifyTokenPassword = new VerifyTokenPassword(
            $this->addCacheTokenStatus
        );
    }

    public function testShouldReturnExceptionIncorrectToken()
    {
        $this->expectException(InvalidResetToken::class);
        $this->expectExceptionMessage('Incorrect token');

        $this->user
             ->method('getCodeAuth')
             ->willReturn('someCode');

        $this->user
            ->method('getId')
            ->willReturn('someCode');

        $this->verifyTokenPassword->isIncorrectToken($this->user, self::INCORRECT_TOKEN);
    }
}