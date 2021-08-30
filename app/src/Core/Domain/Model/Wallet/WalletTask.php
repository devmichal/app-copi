<?php


namespace App\Core\Domain\Model\Wallet;


use App\Core\Domain\Model\Wallet\GS\WalletTaskGS;
use Doctrine\Common\Collections\Collection;

class WalletTask
{
    use WalletTaskGS;

    /** @var string */
    private $id;

    /** @var \DateTime */
    private $createdAt;

    /** @var float */
    private $money = 0.00;

    /** @var Collection */
    private $walletControl;

    public function __construct()
    {
        $this->id        = uuid_create();
        $this->createdAt = new \DateTime();
    }

    public function updateVariable(
        float $payoutMoney
    )
    {
        $this->money = $payoutMoney;
    }
}