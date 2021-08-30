<?php


namespace App\Core\Domain\Model\Wallet;


use App\Core\Application\Command\UserManagement\UserManagementCreate;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\GS\WalletGS;

class Wallet
{
    use WalletGS;

    /** @var string */
    private $id;

    /** @var float */
    private $earnMoney;

    /** @var User */
    private $users;

    /** @var \DateTime */
    private $updatedAt;

    /** @var null|string */
    private $bankName;

    /** @var null|string */
    private $bankNumber;

    /** @var null|string */
    private $street;

    /** @var null|string */
    private $zipCode;

    /** @var null|string */
    private $city;


    public function __construct(
    )
    {
        $this->id         = uuid_create();
        $this->updatedAt  = new \DateTime();
        $this->earnMoney  = 0.0;
    }


    public function updateWallet(UserManagementCreate $managementCreate)
    {
        $this->bankName   = $managementCreate->getBankName();
        $this->bankNumber = $managementCreate->getBankNumber();
        $this->street     = $managementCreate->getStreet();
        $this->zipCode    = $managementCreate->getZipCode();
        $this->city       = $managementCreate->getCity();
        $this->updatedAt  = new \DateTime();
    }
}
