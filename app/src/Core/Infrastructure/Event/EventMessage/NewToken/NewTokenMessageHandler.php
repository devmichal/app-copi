<?php

namespace App\Core\Infrastructure\Event\EventMessage\NewToken;

use App\Shared\Infrastructure\Notification\SendNotificationEmil\SendNotificationEmilInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class NewTokenMessageHandler implements MessageHandlerInterface
{
    private SendNotificationEmilInterface $notificationEmil;

    public function __construct(
        SendNotificationEmilInterface $notificationEmil
    ) {
        $this->notificationEmil = $notificationEmil;
    }

    public function __invoke(NewTokenMessage $message): void
    {
        $this->notificationEmil->send($message->getNotificationEmil());

        sleep(10);
    }
}
