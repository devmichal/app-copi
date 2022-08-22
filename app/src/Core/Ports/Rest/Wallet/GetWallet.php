<?php

namespace App\Core\Ports\Rest\Wallet;

use App\Core\Application\Query\UserManagement\GetUserWallet\UserWalletQuery;
use App\Core\Ports\Rest\QueryApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class GetWallet extends QueryApi
{
    /**
     * @Route("/wallet", methods={"GET"})
     */
    final public function indexAction(): JsonResponse
    {
        $getTasks = new UserWalletQuery($this->getUser());

        return $this->serializeQueryObject($getTasks);
    }
}
