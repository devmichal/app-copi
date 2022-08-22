<?php

namespace App\Shared\Infrastructure\Notification\SendNotificationEmil;

use App\Shared\Infrastructure\Notification\NotificationEmil;

interface SendNotificationEmilInterface
{
    public function send(NotificationEmil $emil): void;
}
