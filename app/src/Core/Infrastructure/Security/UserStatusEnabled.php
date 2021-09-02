<?php


namespace App\Core\Infrastructure\Security;


use App\Core\Domain\Model\Users\User;
use App\Shared\Domain\Exception\DisabledAccount;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;


final class UserStatusEnabled implements UserCheckerInterface
{

    /**
     * @param UserInterface $user
     * @throws DisabledAccount
     */
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {

            throw new DisabledAccount('Account is disabled.');
        }

        if (!$user->isEnabled()) {

            throw new DisabledAccount('Account is disabled.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        //dump('checkPostAuth');
    }

}