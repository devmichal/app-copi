<?php


namespace App\Core\Ports\Rest\TypeText;


use App\Core\Application\Command\TypeText\CreateTypeText\CreateTypeTextCommand;
use App\Core\Application\Command\TypeText\DeleteTypeText\DeleteTypeTextCommand;
use App\Core\Application\Command\TypeText\UpdateTypeText\UpdateTypeTexCommand;
use App\Core\Infrastructure\Form\TypeText\TypeTextType;
use App\Core\Ports\Rest\CreateRestApi;
use App\Shared\Infrastructure\Http\HttpCode;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 *@Route("/api")
 */
class CreateTypeText extends CreateRestApi
{
    /**
     * @Route("/typeText", methods={"POST"})
     */
    final public function createAction(
        Request $request,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $createForm = $this->buildObject($request, TypeTextType::class);

        $eventDispatcher->dispatch(new CreateTypeTextCommand(
            $createForm,
            $this->getUser()
        ), CreateTypeTextCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }

    /**
     * @Route("/typeText/{typeText}", methods={"PUT"})
     */
    final public function updateAction(
        string $typeText,
        Request $request,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $createForm = $this->buildObject($request, TypeTextType::class);

        $eventDispatcher->dispatch(new UpdateTypeTexCommand(
            $createForm,
            $typeText
        ), UpdateTypeTexCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }

    /**
     * @Route("/typeText/{typeText}", methods={"DELETE"})
     */
    final public function deleteAction(
        string $typeText,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $eventDispatcher->dispatch(new DeleteTypeTextCommand(
            $typeText
        ), DeleteTypeTextCommand::NAME);

        return $this->json(null, HttpCode::NO_CONTENT);
    }
}