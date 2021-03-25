<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\User\Mail;

use Eventscase\MovieRental\Domain\Shared\MailSender\MailSenderInterface;

final class SendMailCreateOrderHandler
{
    private $mailerInterface;

    public function __construct(MailSenderInterface $mailerInterface)
    {
        $this->mailerInterface = $mailerInterface;
    }

    public function handle(SendMailCreateUserCommand $command): void
    {
        //@TODO Aquí se enviaría un email al usuario indicando que se ha registrado en la plataforma
    }
}