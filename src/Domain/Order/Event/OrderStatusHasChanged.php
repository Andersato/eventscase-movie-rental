<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Event;

use Eventscase\MovieRental\Domain\Order\Model\Order;

final class OrderStatusHasChanged
{
    private $order;
    private $oldStatus;
    private $newStatus;


    public function __construct(
        Order $order,
        string $oldStatus,
        string $newStatus
    ) {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getOldStatus(): string
    {
        return $this->oldStatus;
    }

    public function getNewStatus(): string
    {
        return $this->newStatus;
    }
}