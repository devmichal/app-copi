<?php


namespace App\Core\Ports\Rest\Client;


use App\Core\Application\Query\Client\GetClients\GetClientsQuery;
use App\Core\Ports\Rest\QueryApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class GetClients extends QueryApi
{

    /**
     * @Route("/client", methods={"GET"})
     */
    final public function indexAction(): JsonResponse
    {
        $getClients = new GetClientsQuery($this->getUser());

        return $this->serializeQueryObject($getClients);
    }
}