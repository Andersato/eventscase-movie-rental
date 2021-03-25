<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Shared\Mail;

use Eventscase\MovieRental\Domain\Shared\MailSender\MailSenderInterface;

final class SwiftMailSender implements MailSenderInterface
{

    public function send(
        string $to,
        string $body,
        string $subject,
        array $from,
        string $replyTo = null,
        string $bcc = null,
        array $files = []
    ): void {
        // TODO: Implement send() method.
    }
}