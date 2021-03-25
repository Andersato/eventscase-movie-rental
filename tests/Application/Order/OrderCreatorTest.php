<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Order;

use Eventscase\MovieRental\Application\Order\Create\CreateOrderCommand;
use Eventscase\MovieRental\Application\Order\Dto\OrderLineItem;
use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Domain\Order\Model\Order;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Tests\BaseTestCase;
use Eventscase\MovieRental\Utils\TestData;
use Ramsey\Uuid\Uuid;

final class OrderCreatorTest extends BaseTestCase
{
    public function testOrderCreator(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var OrderRepositoryInterface $orderRepository */
        $orderRepository = $this->get(OrderRepositoryInterface::class);

        /** @var MovieRepositoryInterface $movieRepository */
        $movieRepository = $this->get(MovieRepositoryInterface::class);

        /** @var UserRepositoryInterface $userRepository */
        $userRepository = $this->get(UserRepositoryInterface::class);

        $movies  = TestData::MoviesData();
        $users   = TestData::UsersData();
        /** @var Movie $movie */
        $movie = $movies[0];
        /** @var User $user */
        $user  = $users[0];

        $movieRepository->store($movie, true);
        $userRepository->store($user, true);

        $uuid = Uuid::uuid1();
        $items[] = new OrderLineItem(
            $uuid->toString(),
            $movie->getId()->value()->toString(),
            5,
            4
        );

        $uuidOrder = Uuid::uuid1();
        $command = new CreateOrderCommand(
            $uuidOrder->toString(),
            $user->getUserAuth()->getEmail(),
            $items
        );

        $commandBus->handle($command);

        /** @var Order $order */
        $order = $orderRepository->find(new OrderId($uuidOrder));

        $this->assertNotNull($order);
        $this->assertEquals($uuidOrder, $order->getId()->value());
        $this->assertCount(1, $order->getOrderLines());
        $this->assertEquals(20, $order->getPrice());
        $this->assertEquals(Order::STATUS_RENTEND, $order->getStatus());
        $this->assertEquals($user, $order->getUser());
    }
}