<?php

namespace App\Core\Ports\Rest\TallyTaskComponent;

use App\Core\Application\Query\Client\GetClients\GetClientsQuery;
use App\Core\Application\Query\TypeText\GetTypeText\TypeTextQuery;
use App\Shared\Infrastructure\ValueObject\TallyTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class TaskComponent extends AbstractController
{
    use HandleTrait;

    private SerializerInterface $serializer;

    public function __construct(
        MessageBusInterface $queryBus,
        SerializerInterface $serializer
    ) {
        $this->messageBus = $queryBus;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/task/component", methods={"GET"})
     */
    final public function indexAction(): JsonResponse
    {
        $getClients = new GetClientsQuery($this->getUser());
        $getTypeText = new TypeTextQuery($this->getUser());

        $client = $this->handle($getClients);
        $text = $this->handle($getTypeText);

        $tallyTask = new TallyTask($client, $text);

        $serializerClient = $this->serializer->serialize($tallyTask, 'json');

        return JsonResponse::fromJsonString($serializerClient);
    }
}
