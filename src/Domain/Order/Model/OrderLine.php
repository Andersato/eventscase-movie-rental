<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Model;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Order\Response\OrderLineResponse;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderLineId;
use Eventscase\MovieRental\Domain\Shared\Transform\DataResponse;
use Eventscase\MovieRental\Domain\Shared\Transform\DataTransformerInterface;

class OrderLine implements DataTransformerInterface
{
    private $id;
    private $order;
    private $movie;
    private $price;
    private $quantity;

    public function __construct(OrderLineId $id, Order $order, Movie $movie, float $price, int $quantity)
    {
        $this->id     = $id;
        $this->order  = $order;
        $this->movie  = $movie;
        $this->price  = $price;
        $this->quantity = $quantity;

        $order->addOrderLine($this);
    }

    public function getId(): OrderLineId
    {
        return $this->id;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function transform(): DataResponse
    {
        return new OrderLineResponse(
            $this->getId()->value()->toString(),
            $this->getPrice(),
            $this->getQuantity(),
            $this->movie->transform()
        );
    }

}