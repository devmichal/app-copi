<?php

namespace App\Tests\Shared\Infrastructure\Notification\FactoryEmil;


use App\Shared\Domain\Enum\Email\TypeEmail;
use App\Shared\Infrastructure\Notification\FactoryEmil\FactoryEmail;
use App\Shared\Infrastructure\Notification\NotificationEmil;
use PHPUnit\Framework\TestCase;

class FactoryEmailTest extends TestCase
{
    public const USER_EMAIL  = 'some-token';
    public const USER_TOKEN  = 'someToken';


    final public function testShouldReturnEmailDataToResetPassword(): void
    {
        $result = FactoryEmail::resetPassword(self::USER_EMAIL, self::USER_TOKEN);

        $this->assertEquals(TypeEmail::RESET_PASSWORD->value, $result->getTitleEmail());
        $this->assertEquals(self::USER_EMAIL, $result->getRecipientEmail());
        $this->assertIsArray($result->getDataEmail());
    }

}