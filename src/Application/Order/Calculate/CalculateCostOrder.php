<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Calculate;

use Eventscase\MovieRental\Application\Order\Dto\OrderLineItem;

final class CalculateCostOrder
{
    private $items = [];

    public function addItem(OrderLineItem $item): void
    {
        $this->items[] = $item;
    }

    public function calculate(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }

        return round($total, 2);
    }
}