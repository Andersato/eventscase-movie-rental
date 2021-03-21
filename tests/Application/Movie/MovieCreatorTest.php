<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Movie;

use Eventscase\MovieRental\Application\Movie\Create\CreateMovieCommand;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Domain\Shared\ValueObject\Uuid;
use Eventscase\MovieRental\Tests\BaseTestCase;

class MovieCreatorTest extends BaseTestCase
{
    public function testMovieCreator(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var MovieRepositoryInterface $repository */
        $repository = $this->get(MovieRepositoryInterface::class);

        $movieId = Uuid::random()->value();

        $command = new CreateMovieCommand(
           $movieId,
            'Movie test',
            'Description movie test',
            5,
            2018,
            90,
            8
        );

        $commandBus->handle($command);

        $movie = $repository->find(new MovieId($movieId));
        $this->assertNotNull($movie);

        $this->assertEquals($movie->getId()->value(), $command->getId());
        $this->assertEquals($movie->getTitle(), $command->getTitle());
        $this->assertEquals($movie->getDescription(), $command->getDescription());
        $this->assertEquals($movie->getPrice(), $command->getPrice());
        $this->assertEquals($movie->getYear(), $command->getYear());
        $this->assertEquals($movie->getDuration(), $command->getDuration());
        $this->assertEquals($movie->getStock(), $command->getStock());
    }
}