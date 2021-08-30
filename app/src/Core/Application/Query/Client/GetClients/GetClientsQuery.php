<?php


namespace App\Core\Application\Query\Client\GetClients;


use App\Core\Domain\Model\Users\User;


final class GetClientsQuery
{
    private User $user;


    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}