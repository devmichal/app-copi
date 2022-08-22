<?php

namespace App\Core\Application\Query\UserManagement\GetUserWallet;

use App\Core\Application\Query\UserManagement\WalletDTO;

final class UserWalletQueryHandler
{
    public function __invoke(UserWalletQuery $query): WalletDTO
    {
        $wallet = $query->getUser()->getWallet();

        return WalletDTO::fromEntity($wallet);
    }
}
