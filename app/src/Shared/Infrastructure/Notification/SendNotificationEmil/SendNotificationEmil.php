<?php

namespace App\Shared\Infrastructure\Notification\SendNotificationEmil;

use App\Shared\Domain\Enum\Email\TypeEmail;
use App\Shared\Infrastructure\Notification\NotificationEmil;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

final class SendNotificationEmil implements SendNotificationEmilInterface
{
    private MailerInterface $mailer;

    private Environment $twig;

    public function __construct(
        MailerInterface $mailer,
        Environment $twig
    ) {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(NotificationEmil $notificationEmil): void
    {
        $subject = TypeEmail::fromId($notificationEmil->getTitleEmail())->name();
        $typeEmail = $notificationEmil->getTitleEmail();

        $email = (new Email())
            ->from($_ENV['MAILER_FROM'])
            ->to($notificationEmil->getRecipientEmail())
            ->subject($subject)
            ->html($this->twig->render("email/email-$typeEmail.html.twig", [
                'emailData' => $notificationEmil->getDataEmail(),
                'date' => new \DateTime(),
            ]));

        $this->mailer->send($email);
    }
}
