<?php

namespace App\Core\Ports\Rest\Files;

use App\Core\Application\Command\Files\UploadFile\UploadFileCommand;
use App\Shared\Infrastructure\Http\HttpCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class UploadFile extends AbstractController
{
    /**
     * @Route("/uplopad/files/{task}", methods={"POST"})
     */
    final public function indexAction(
        Request $request,
        string $task,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse {
        if ($request->files->get('file')) {
            $eventDispatcher->dispatch(new UploadFileCommand(
                $request->files->get('file'),
                $task
            ), UploadFileCommand::NAME);
        }

        return $this->json(null, HttpCode::NO_CONTENT);
    }
}
