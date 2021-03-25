<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Transition;

use Eventscase\MovieRental\Domain\Order\Exception\OrderNotFoundException;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;

final class ApplyOrderTransitionHandler
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(ApplyOrderTransitionCommand $command): void
    {
        $order = $this->orderRepository->find(new OrderId(OrderId::fromString($command->getOrderId())));

        if (null === $order) {
            throw new OrderNotFoundException('La orden no existe');
        }

        $order->changeStatus($command->getTransition());

        $this->orderRepository->store($order, true);
    }

}