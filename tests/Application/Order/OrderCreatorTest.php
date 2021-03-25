<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Order;

use Eventscase\MovieRental\Application\Order\Create\CreateOrderCommand;
use Eventscase\MovieRental\Application\Order\Dto\OrderLineItem;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;
use Eventscase\MovieRental\Tests\BaseTestCase;
use Ramsey\Uuid\Uuid;

final class OrderCreatorTest extends BaseTestCase
{
    public function testOrderCreator(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var OrderRepositoryInterface $repository */
        $orderRepository = $this->get(OrderRepositoryInterface::class);

        $movieIds   = $this->addTestMovies();
        $userEmails = $this->addTestUsers();

        $uuid = Uuid::uuid1();
        $items[] = new OrderLineItem(
            $uuid->toString(),
            $movieIds[0],
            5,
            4
        );

        $uuidOrder = Uuid::uuid1();
        $command = new CreateOrderCommand(
            $uuidOrder->toString(),
            $userEmails[0],
            $items
        );

        $commandBus->handle($command);

        $order = $orderRepository->find(new OrderId($uuidOrder));
        $this->assertNotNull($order);
    }
}