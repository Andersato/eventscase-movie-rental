<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Workflow;

use Eventscase\MovieRental\Domain\Order\Model\Order;
use Eventscase\MovieRental\Domain\Shared\Workflow\AbstractWorkflow;

final class OrderStatusWorkflow extends AbstractWorkflow
{
    /**
     * @return array
     */
    public static function getTransitions(): array
    {
        return [
            Order::TRANSITION_TO_CANCELLED => [
                'from' => Order::STATUS_RENTEND,
                'to'   => Order::STATUS_CANCELLED,
            ],
            Order::TRANSITION_TO_SENT => [
                'from' => [Order::STATUS_RENTEND],
                'to'   => Order::STATUS_SENT,
            ],
            Order::TRANSITION_TO_RECEIVED => [
                'from' => [Order::STATUS_SENT],
                'to'   => Order::STATUS_RECEIVED,
            ],
            Order::TRANSITION_TO_UNRECEIVED => [
                'from' => [Order::STATUS_SENT],
                'to'   => Order::STATUS_UNRECEIVED,
            ],
            Order::TRANSITION_TO_DELIVERED => [
                'from' => [Order::STATUS_RECEIVED],
                'to' => Order::STATUS_DELIVERED,
            ],
            Order::TRANSITION_TO_RETURNED => [
                'from' => [Order::STATUS_DELIVERED],
                'to' => Order::STATUS_RETURNED,
            ],
        ];
    }

    /**
     * @return string
     */
    public static function getProperty(): string
    {
        return 'status';
    }
}
