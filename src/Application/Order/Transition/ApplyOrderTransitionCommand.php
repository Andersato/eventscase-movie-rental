<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Transition;

final class ApplyOrderTransitionCommand
{
    private $orderId;
    private $transition;

    public function __construct(string $orderId, string $transition)
    {
        $this->orderId    = $orderId;
        $this->transition = $transition;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getTransition(): string
    {
        return $this->transition;
    }
}