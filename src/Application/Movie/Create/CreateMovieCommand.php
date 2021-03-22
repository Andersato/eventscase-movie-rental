<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Movie\Create;

final class CreateMovieCommand
{
    private $id;
    private $title;
    private $description;
    private $price;
    private $year;
    private $duration;
    private $stock;

    public function __construct(string $id, string $title, string $description, float $price, int $year, int $duration, int $stock)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->price       = $price;
        $this->year        = $year;
        $this->duration    = $duration;
        $this->stock       = $stock;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getStock(): int
    {
        return $this->stock;
    }
}