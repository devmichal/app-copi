<?php

namespace App\Shared\Infrastructure\Notification;

final class NotificationEmil
{
    private int $titleEmail;

    private string $recipientEmail;

    private array $dataEmail;


    public function __construct(
        int $titleEmail,
        string $recipientEmail,
        array $dataEmail
    )
    {
        $this->titleEmail = $titleEmail;
        $this->recipientEmail = $recipientEmail;
        $this->dataEmail = $dataEmail;
    }

    /**
     * @return int
     */
    public function getTitleEmail(): int
    {
        return $this->titleEmail;
    }

    /**
     * @return string
     */
    public function getRecipientEmail(): string
    {
        return $this->recipientEmail;
    }

    /**
     * @return array
     */
    public function getDataEmail(): array
    {
        return $this->dataEmail;
    }
}