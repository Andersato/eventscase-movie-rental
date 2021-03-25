<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Mail;

use Eventscase\MovieRental\Domain\Shared\MailSender\MailSenderInterface;

final class SendMailCreateOrderHandler
{
    private $mailerInterface;

    public function __construct(MailSenderInterface $mailerInterface)
    {
        $this->mailerInterface = $mailerInterface;
    }

    public function handle(SendMailCreateOrderCommand $command): void
    {
       // @TODO Aquí se enviaría un email al cliente, se escribiría algún log ...
    }
}