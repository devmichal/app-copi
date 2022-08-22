<?php

namespace App\Tests\Core\Infrastructure\Security\CheckTokenCsrf;

use App\Core\Infrastructure\RedisRepository\Csrf\GetCsrfSession;
use App\Core\Infrastructure\Security\CheckTokenCsrf\CheckTokenCsrf;
use App\Shared\Domain\Exception\InvalidCsrfToken;
use PHPUnit\Framework\TestCase;

class CheckTokenCsrfTest extends TestCase
{
    public const USER_ID = 'someID';
    public const TOKEN_CSRF = '123Fk42';
    public const BAD_CSRF = '9k98931';

    private CheckTokenCsrf $checkTokenCsrf;

    /** @var GetCsrfSession|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $getCsrfSession;

    protected function setUp(): void
    {
        $this->getCsrfSession = $this->createMock(GetCsrfSession::class);

        $this->checkTokenCsrf = new CheckTokenCsrf(
            $this->getCsrfSession
        );
    }

    public function testShouldReturnExceptionIncorrectTokenCsrf()
    {
        $this->expectException(InvalidCsrfToken::class);
        $this->expectExceptionMessage('Csrf token is invalid');

        $this->getCsrfSession
             ->method('getSession')
             ->willReturn(self::BAD_CSRF);

        $this->checkTokenCsrf->isCorrect(self::USER_ID, self::TOKEN_CSRF);
    }

    public function testShouldReturnNullCorrectTokenCsrf()
    {
        $this->getCsrfSession
            ->method('getSession')
            ->willReturn(self::TOKEN_CSRF);

        $result = $this->checkTokenCsrf->isCorrect(self::USER_ID, self::TOKEN_CSRF);

        $this->assertNull($result);
    }
}
