<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Dto;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;

final class OrderLineItem
{
    private $id;
    private $movieId;
    private $quantity;
    private $price;
    private $movie;

    public function __construct(string $id, string $movieId, int $quantity, float $price)
    {
        $this->id       = $id;
        $this->movieId  = $movieId;
        $this->quantity = $quantity;
        $this->price    = $price;
    }

    public function addMovie(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMovieId(): string
    {
        return $this->movieId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getMovie()
    {
        return $this->movie;
    }
}