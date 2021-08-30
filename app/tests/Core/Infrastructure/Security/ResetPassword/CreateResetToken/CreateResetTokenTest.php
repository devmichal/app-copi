<?php

namespace App\Tests\Core\Infrastructure\Security\ResetPassword\CreateResetToken;


use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Security\ResetPassword\CreateResetToken\CreateResetToken;
use PHPUnit\Framework\TestCase;


class CreateResetTokenTest extends TestCase
{
    const LENGTH_TOKEN = 8;

    /** @var CreateResetToken  */
    private CreateResetToken $createResetToken;

    protected function setUp(): void
    {
        $this->createResetToken = new CreateResetToken();
    }

    public function testShouldCreateRandomTokenWithEightLengthCharacter()
    {
        $result = $this->createResetToken->createToken();

        $this->assertEquals(self::LENGTH_TOKEN, strlen($result->getUserToken()));
        $this->assertTrue(password_verify($result->getUserToken(),$result->getHashToken()));
    }

}