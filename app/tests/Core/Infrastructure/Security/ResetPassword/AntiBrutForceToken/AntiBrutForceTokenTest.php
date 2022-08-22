<?php

namespace App\Tests\Core\Infrastructure\Security\ResetPassword\AntiBrutForceToken;

use App\Core\Infrastructure\RedisRepository\Users\GetCacheTokenStatus;
use App\Core\Infrastructure\Security\ResetPassword\AntiBrutForceToken\AntiBrutForceToken;
use PHPUnit\Framework\TestCase;

class AntiBrutForceTokenTest extends TestCase
{
    public const ID_USER = 'somUniqId';

    private AntiBrutForceToken $antiBrutForceToken;

    /** @var GetCacheTokenStatus|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $brutForceToken;

    protected function setUp(): void
    {
        $this->brutForceToken = $this->createMock(GetCacheTokenStatus::class);

        $this->antiBrutForceToken = new AntiBrutForceToken(
            $this->brutForceToken
        );
    }

    public function testShouldReturnFalseUserNoCrossLimitOfIncorrectToken()
    {
        $result = $this->antiBrutForceToken->isToMoneyWrongToken(self::ID_USER);

        $this->assertFalse($result);
    }

    public function testShouldReturnTrueToManyWrongToken()
    {
        $this->brutForceToken
             ->method('getCacheBadToken')
             ->willReturn(3);

        $result = $this->antiBrutForceToken->isToMoneyWrongToken(self::ID_USER);

        $this->assertTrue($result);
    }
}
