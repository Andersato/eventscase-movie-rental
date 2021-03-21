<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Movie\Repository;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;

interface MovieRepositoryInterface
{
    public function find(MovieId $id): ?Movie;

    public function store(Movie $movie, bool $flush = false): void;
}