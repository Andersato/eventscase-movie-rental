<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Response;

use Eventscase\MovieRental\Domain\Movie\Response\MovieResponse;
use Eventscase\MovieRental\Domain\Shared\Transform\DataResponse;

class OrderLineResponse implements DataResponse
{
    private $id;
    private $movie;
    private $price;
    private $quantity;

    public function __construct(string $id, float $price, int $quantity, MovieResponse $movie = null)
    {
        $this->id       = $id;
        $this->price    = $price;
        $this->quantity = $quantity;
        $this->movie    = $movie;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMovie(): MovieResponse
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
}