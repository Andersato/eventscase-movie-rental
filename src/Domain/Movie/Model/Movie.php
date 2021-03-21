<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Movie\Model;

use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;
use BornFree\TacticianDomainEvent\Recorder\EventRecorderCapabilities;
use Doctrine\Common\Collections\ArrayCollection;
use Eventscase\MovieRental\Domain\Movie\Event\MovieWasCreated;
use Eventscase\MovieRental\Domain\Shared\Traits\DateTimeTrait;

final class Movie implements ContainsRecordedEvents
{
    use EventRecorderCapabilities;
    use DateTimeTrait;

    private $id;
    private $title;
    private $description;
    private $price;
    private $year;
    private $duration;
    private $stock;
    private $orderLines;

    public function __construct(MovieId $id, string $title, string $description, float $price, int $year, int $duration, int $stock)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->price       = $price;
        $this->year        = $year;
        $this->duration    = $duration;
        $this->stock       = $stock;
        $this->orderLines  = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();

        $this->record(new MovieWasCreated($this));
    }

    public function getId(): MovieId
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

    public function getOrderLines(): ArrayCollection
    {
        return $this->orderLines;
    }
}