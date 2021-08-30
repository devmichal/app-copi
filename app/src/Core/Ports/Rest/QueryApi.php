<?php


namespace App\Core\Ports\Rest;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;


abstract class QueryApi extends AbstractController
{
    use HandleTrait;

    private SerializerInterface $serializer;

    public function __construct(
        MessageBusInterface $queryBus,
        SerializerInterface $serializer
    )
    {
        $this->messageBus = $queryBus;
        $this->serializer = $serializer;
    }

    protected function serializeQueryObject(
        $queryObject
    ): JsonResponse
    {
        $client = $this->handle($queryObject);

        $serializerClient = $this->serializer->serialize($client, 'json');

        return JsonResponse::fromJsonString($serializerClient);
    }
}