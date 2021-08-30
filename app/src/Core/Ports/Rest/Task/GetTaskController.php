<?php


namespace App\Core\Ports\Rest\Task;


use App\Core\Application\Query\Task\GetTasks\GetTasksQuery;
use App\Core\Ports\Rest\QueryApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class GetTaskController extends QueryApi
{

    /**
     * @Route("/task", methods={"GET"})
     */
    final public function indexAction(): JsonResponse
    {
        $getTasks = new GetTasksQuery($this->getUser());

        return $this->serializeQueryObject($getTasks);
    }

}