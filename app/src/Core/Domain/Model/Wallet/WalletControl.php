<?php


namespace App\Core\Domain\Model\Wallet;


use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\GS\WalletControlGS;
use DateTime;


class WalletControl
{
    use WalletControlGS;

    private string $id;

    private DateTime $createdAt;

    private float $money;

    private WalletTask $walletTask;

    private User $users;

    public function __construct(
        User $user,
        float $earMoney
    )
    {
        $this->id         = uuid_create();
        $this->users      = $user;
        $this->createdAt  = new \DateTime();
        $this->walletTask = $user->getWallet();
        $this->money      = $earMoney;
    }
}
