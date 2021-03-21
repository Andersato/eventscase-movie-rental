<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Model;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;

final class OrderLine
{
    private $id;
    private $order;
    private $movie;
    private $price;
    private $amount;

    public function __construct(OrderLineId $id, Order $order, Movie $movie, float $price, int $amount)
    {
        $this->id     = $id;
        $this->order  = $order;
        $this->movie  = $movie;
        $this->price  = $price;
        $this->amount = $amount;
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

    public function getAmount(): int
    {
        return $this->amount;
    }

}