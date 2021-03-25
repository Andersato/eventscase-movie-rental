<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Order\EventListener;

use Eventscase\MovieRental\Domain\Order\Event\OrderStatusHasChanged;

final class OrderStatusChangeListener
{
    public function onOrderStatusChanged(OrderStatusHasChanged $event)
    {
        //@TODO Hacer envío de emails según determinados estados, esribir en logs, etc...
    }
}