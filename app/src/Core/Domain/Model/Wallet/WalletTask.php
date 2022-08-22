<?php

namespace App\Core\Domain\Model\Wallet;

use App\Core\Domain\Model\Wallet\GS\WalletTaskGS;
use DateTime;
use Doctrine\Common\Collections\Collection;

class WalletTask
{
    use WalletTaskGS;

    private string $id;

    private DateTime $createdAt;

    private float $money = 0.00;

    private Collection $walletControl;

    public function __construct(
        float $payoutMoney
    ) {
        $this->money = $payoutMoney;
        $this->id = uuid_create();
        $this->createdAt = new DateTime();
    }

    final public function updateVariable(
        float $payoutMoney
    ): void {
        $this->money = $payoutMoney;
    }
}
