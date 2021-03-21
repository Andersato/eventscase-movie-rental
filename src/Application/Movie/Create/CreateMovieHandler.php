<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Movie\Create;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;

final class CreateMovieHandler
{
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(CreateMovieCommand $command): void
    {
        $movie = new Movie(
            new MovieId($command->getId()),
            $command->getTitle(),
            $command->getDescription(),
            $command->getPrice(),
            $command->getYear(),
            $command->getDuration(),
            $command->getStock()
        );

        $this->movieRepository->store($movie, true);
    }
}