<?php

namespace App\Tests\Core\Infrastructure\Security\ResetPassword\TimeToLiveToken;


use App\Core\Infrastructure\Security\ResetPassword\TimeToLiveToken\TimeToLiveToken;
use PHPUnit\Framework\TestCase;

class TimeToLiveTokenTest extends TestCase
{
    const TIME = '- 13 minutes';

    /** @var TimeToLiveToken  */
    private TimeToLiveToken $timeToLiveToken;

    protected function setUp(): void
    {
       $this->timeToLiveToken = new TimeToLiveToken();
    }

    public function testShouldReturnFalseTokenIsStillActive()
    {
        $actualData = new \DateTime();
        $result = $this->timeToLiveToken->isExpirationToken($actualData);

        $this->assertFalse($result);
    }

    public function testShouldReturnTrueTokenExpirationAt()
    {
        $expirationAt = new \DateTime(self::TIME);
        $result = $this->timeToLiveToken->isExpirationToken($expirationAt);

        $this->assertTrue($result);
    }



}