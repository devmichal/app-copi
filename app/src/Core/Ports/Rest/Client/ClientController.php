<?php


namespace App\Core\Ports\Rest\Client;


use App\Core\Application\Command\Client\CreateClient\CreateClientCommand;
use App\Core\Application\Command\Client\DeleteClient\DeleteClientCommand;
use App\Core\Application\Command\Client\UpdateClient\UpdateClientCommand;
use App\Core\Infrastructure\Form\Client\ClientType;
use App\Core\Ports\Rest\CreateRestApi;
use App\Shared\Infrastructure\Http\HttpCode;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ClientController extends CreateRestApi
{
    /**
     * @Route("/client", methods={"POST"})
     */
    final public function createAction(
        Request $request,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $clientForm = $this->buildObject($request, ClientType::class);

        $eventDispatcher->dispatch(new CreateClientCommand(
            $clientForm,
            $this->getUser()
        ), CreateClientCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }

    /**
     * @Route("/client/{client}", methods={"PUT"})
     */
    final public function updateAction(
        Request $request,
        EventDispatcherInterface $eventDispatcher,
        string $client
    ): JsonResponse
    {
        $clientForm = $this->buildObject($request, ClientType::class);

        $eventDispatcher->dispatch(new UpdateClientCommand(
           $clientForm,
           $client
        ), UpdateClientCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }

    /**
     * @Route("/client/{client}", methods={"DELETE"})
     */
    final public function deleteAction(
        string $client,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $eventDispatcher->dispatch(new DeleteClientCommand(
            $client), DeleteClientCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }

}