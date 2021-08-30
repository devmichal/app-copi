<?php


namespace App\Core\Domain\Model\Wallet;

use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\GS\WalletControlGS;

class WalletControl
{
    use WalletControlGS;

    /** @var string */
    private $id;

    /** @var \DateTime */
    private $createdAt;

    /** @var float */
    private $money;

    /** @var WalletTask */
    private $walletTask;

    /** @var User */
    private $users;

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
