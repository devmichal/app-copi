<?php

namespace App\Core\Infrastructure\Event\EventSubscriber;


use App\Shared\Domain\Exception\BrutForceLoginException;
use App\Shared\Domain\Exception\DisabledAccount;
use App\Shared\Domain\Exception\InvalidResetToken;
use App\Shared\Domain\Exception\InvalidUser;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;


final class ExceptionTokenHandler implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return[
            KernelEvents::EXCEPTION => [
                ['processException', -10]
            ]
        ];
    }

    public function processException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        do {
            if ($exception instanceof InvalidResetToken) {

                $this->refreshToken($event);
                return;
            }

            if ($exception instanceof BrutForceLoginException) {

                $this->refreshToken($event);
                return;
            }

            if ($exception instanceof DisabledAccount) {

                $this->refreshToken($event);
                return;
            }

            if ($exception instanceof InvalidUser) {

                $this->invalidUser($event);
                return;
            }
        } while (null !== $exception = $exception->getPrevious());
    }


    private function refreshToken(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response  = new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }

    private function invalidUser(ExceptionEvent $event): void
    {
        $response  = new JsonResponse(null, Response::HTTP_NO_CONTENT);
        $event->setResponse($response);
    }
}