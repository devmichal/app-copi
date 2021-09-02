<?php


namespace App\Core\Domain\Model\Wallet;


use App\Core\Application\Command\UserManagement\UserManagementCreate;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\GS\WalletGS;
use DateTime;


class Wallet
{
    use WalletGS;

    private string $id;

    private float $earnMoney;

    private User $users;

    private DateTime $updatedAt;

    private ?string $bankName = null;

    private ?string $bankNumber = null;

    private ?string $street = null;

    private ?string $zipCode = null;

    private ?string $city = null;


    public function __construct(
    )
    {
        $this->id         = uuid_create();
        $this->updatedAt  = new DateTime();
        $this->earnMoney  = 0.0;
    }


    final public function updateWallet(UserManagementCreate $managementCreate): void
    {
        $this->bankName   = $managementCreate->getBankName();
        $this->bankNumber = $managementCreate->getBankNumber();
        $this->street     = $managementCreate->getStreet();
        $this->zipCode    = $managementCreate->getZipCode();
        $this->city       = $managementCreate->getCity();
        $this->updatedAt  = new DateTime();
    }
}
