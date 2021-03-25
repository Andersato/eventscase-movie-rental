<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Movie\Event;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;

final class MovieWasCreated
{
    private $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}