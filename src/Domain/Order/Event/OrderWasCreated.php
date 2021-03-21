<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Event;

use Eventscase\MovieRental\Domain\Order\Model\Order;

final class OrderWasCreated
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}