<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Order\EventListener;

use Eventscase\MovieRental\Application\Order\Mail\SendMailCreateOrderCommand;
use Eventscase\MovieRental\Domain\Order\Event\OrderWasCreated;
use League\Tactician\CommandBus;

final class OrderWasCreatedListener
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function onOrderWasCreated(OrderWasCreated $event)
    {
        $order = $event->getOrder();

        $this->commandBus->handle(
            new SendMailCreateOrderCommand($order->getUser()->getId()->value()->toString())
        );
    }
}