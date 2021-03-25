<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Movie;

use Eventscase\MovieRental\Application\Movie\Find\GetMovieQuery;
use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Tests\BaseTestCase;
use Eventscase\MovieRental\Utils\TestData;

class MovieGetTest extends BaseTestCase
{
    public function testMovieCreator(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var MovieRepositoryInterface $repository */
        $repository = $this->get(MovieRepositoryInterface::class);

        $movies = TestData::MoviesData();
        /** @var Movie $movie */
        $movie = $movies[0];

        $repository->store($movie, true);

        $command = new GetMovieQuery($movie->getId()->value()->toString());
        $commandBus->handle($command);

        $movieResult = $repository->find($movie->getId());
        $this->assertNotNull($movieResult);

        $this->assertEquals($movieResult->getId(), $movie->getId());
        $this->assertEquals($movieResult->getTitle(), $movie->getTitle());
        $this->assertEquals($movieResult->getDescription(), $movie->getDescription());
        $this->assertEquals($movieResult->getPrice(), $movie->getPrice());
        $this->assertEquals($movieResult->getYear(), $movie->getYear());
        $this->assertEquals($movieResult->getDuration(), $movie->getDuration());
        $this->assertEquals($movieResult->getStock(), $movie->getStock());
    }
}