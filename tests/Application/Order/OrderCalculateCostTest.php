<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Order;

use Eventscase\MovieRental\Application\Order\Calculate\CalculateCostOrder;
use Eventscase\MovieRental\Application\Order\Dto\OrderLineItem;
use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Tests\BaseTestCase;
use Eventscase\MovieRental\Utils\TestData;
use Ramsey\Uuid\Uuid;

final class OrderCalculateCostTest extends BaseTestCase
{
    public function testOrderCalculateCost(): void
    {
        $movies = TestData::MoviesData();
        /** @var Movie $movie1 */
        $movie1 = $movies[0];
        /** @var Movie $movie2 */
        $movie2 = $movies[1];

        $uuid1 = Uuid::uuid1();
        $uuid2 = Uuid::uuid1();

        $calculator = new CalculateCostOrder();
        $calculator->addItem(new OrderLineItem(
            $uuid1->toString(),
            $movie1->getId()->value()->toString(),
            5,
            4
        ));
        $calculator->addItem(new OrderLineItem(
            $uuid2->toString(),
            $movie2->getId()->value()->toString(),
            2,
            3
        ));

        $result = (2*3) + (5*4);

        $this->assertEquals($result, $calculator->calculate());
    }
}