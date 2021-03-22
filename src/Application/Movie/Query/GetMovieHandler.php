<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Movie\Query;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;

final class GetMovieHandler
{
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(GetMovieCommand $command): Movie
    {
        $uuid = MovieId::fromString($command->getId());

        $movie = $this->movieRepository->find(new MovieId($uuid));

        return $movie;
    }
}