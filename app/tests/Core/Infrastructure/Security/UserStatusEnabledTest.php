<?php


namespace App\Tests\Core\Infrastructure\Security;


use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Security\UserStatusEnabled;
use App\Shared\Domain\Exception\DisabledAccount;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\DisabledException;

class UserStatusEnabledTest extends TestCase
{
    /** @var UserStatusEnabled  */
    private UserStatusEnabled $userStatusEnabled;

    protected function setUp(): void
    {
        $this->userStatusEnabled = new UserStatusEnabled();
    }

    public function testShouldReturnExceptionUserIsDisabled()
    {
        $this->expectException(DisabledAccount::class);
        $this->expectExceptionMessage('Account is disabled.');

        $this->userStatusEnabled->checkPreAuth(new User());
    }

    public function testShouldReturnNullUserIsActive()
    {
        $user = new User();
        $user->managerEnabledUser(true);

        $result = $this->userStatusEnabled->checkPreAuth($user);

        $this->assertEmpty($result);
    }

}