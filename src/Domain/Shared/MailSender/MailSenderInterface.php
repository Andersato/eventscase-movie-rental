<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\MailSender;

interface MailSenderInterface
{
    public function send(string $to, string $body, string $subject, array $from, string $replyTo = null, string $bcc = null, array $files = []): void;
}