<?php

namespace App\Tests\Core\Infrastructure\Security\AntiBrutForce;

use App\Core\Infrastructure\RedisRepository\AntiBrutForce\BrutForceManagerCache;
use App\Core\Infrastructure\Security\AntiBrutForce\HandlerFailLoginUser;
use App\Shared\Domain\Exception\BrutForceLoginException;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class HandlerFailLoginUserTest extends TestCase
{
    public const SUM_EXCEED_LIMIT = 4;
    public const SUM_NO_EXCEED = 2;
    public const ACTUAL_WRONG = 3;

    private HandlerFailLoginUser $handlerFailLoginUser;

    /** @var BrutForceManagerCache|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $brutForceManagerCache;

    /** @var AuthenticationFailureEvent|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $authenticationFailure;

    /** @var mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $authenticationException;

    /** @var mixed|\PHPUnit\Framework\MockObject\MockObject|EventDispatcherInterface */
    private $eventDispatcher;

    protected function setUp(): void
    {
        $this->brutForceManagerCache = $this->createMock(BrutForceManagerCache::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $this->authenticationFailure = $this->createMock(AuthenticationFailureEvent::class);
        $this->authenticationException = $this->createMock(AuthenticationException::class);

        $this->authenticationFailure
             ->method('getException')
             ->willReturn($this->authenticationException);

        $this->authenticationException
             ->method('getToken')
             ->willReturn(new MockUserRequest());

        $this->handlerFailLoginUser = new HandlerFailLoginUser(
            $this->brutForceManagerCache,
            $this->eventDispatcher
        );
    }

    public function testShouldReturnNullUserDoesNotExceedLimitOfWrongLogin()
    {
        $this->brutForceManagerCache
             ->method('getStatusLogin')
             ->willReturn(self::SUM_NO_EXCEED);

        $this->brutForceManagerCache->expects(self::once())
             ->method('setWrongLogin')
             ->with(self::callback(fn (int $wrongLogin): bool => self::ACTUAL_WRONG === $wrongLogin
             ));

        $this->handlerFailLoginUser->addIncorrectLogin($this->authenticationFailure);
    }

    public function testShouldReturnExceptionUserExceedLimitOfWrongLoginDisableAccount()
    {
        $this->expectException(BrutForceLoginException::class);

        $this->brutForceManagerCache
             ->method('getStatusLogin')
             ->willReturn(self::SUM_EXCEED_LIMIT);

        $this->handlerFailLoginUser->addIncorrectLogin($this->authenticationFailure);
    }
}
