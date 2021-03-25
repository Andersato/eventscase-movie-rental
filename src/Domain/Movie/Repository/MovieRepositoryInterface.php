<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Movie\Repository;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\ValueObject\MovieId;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface MovieRepositoryInterface
{
    public function find(MovieId $id): ?Movie;

    public function findAllPaginated(): PaginationInterface;

    public function store(Movie $movie, bool $flush = false): void;
}