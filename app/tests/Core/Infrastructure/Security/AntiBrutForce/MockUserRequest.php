<?php

namespace App\Tests\Core\Infrastructure\Security\AntiBrutForce;

final class MockUserRequest
{
    /** @var string */
    private $user = 'someUsername';

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }
}