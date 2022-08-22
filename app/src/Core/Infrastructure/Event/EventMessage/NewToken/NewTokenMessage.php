<?php

namespace App\Core\Infrastructure\Event\EventMessage\NewToken;

use App\Shared\Infrastructure\Notification\NotificationEmil;

final class NewTokenMessage
{
    private NotificationEmil $notificationEmil;

    public function __construct(
        NotificationEmil $notificationEmil
    ) {
        $this->notificationEmil = $notificationEmil;
    }

    public function getNotificationEmil(): NotificationEmil
    {
        return $this->notificationEmil;
    }
}
