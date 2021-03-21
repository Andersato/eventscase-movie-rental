<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Movie\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Infrastructure\Shared\Repository\AbstractRepository;

final class MovieRepository extends AbstractRepository implements MovieRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository = $entityManager->getRepository(Movie::class);
    }

    public function find(MovieId $id): ?Movie
    {
        /** @var Movie $movie */
        $movie = $this->repository->find($id->value());

        return $movie;
    }

    public function store(Movie $movie, bool $flush = false): void
    {
        $this->entityManager->persist($movie);

        if (true === $flush) {
            $this->entityManager->flush();
        }
    }
}