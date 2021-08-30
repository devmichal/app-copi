<?php

namespace App\Core\Ports\Rest\Wallet;


use App\Core\Application\Command\UserManagement\UserManagementCreate\UserManagementCommand;
use App\Core\Infrastructure\Form\Wallet\WalletType;
use App\Core\Ports\Rest\CreateRestApi;
use App\Shared\Infrastructure\Http\HttpCode;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class UpdateWallet extends CreateRestApi
{
    /**
     * @Route("/wallet", methods={"PUT"})
     */
    final public function indexAction(
        Request $request,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $walletTask = $this->buildObject($request,WalletType::class);

        $eventDispatcher->dispatch(new UserManagementCommand(
           $this->getUser(),
           $walletTask
        ), UserManagementCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }
}