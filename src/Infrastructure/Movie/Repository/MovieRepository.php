<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Movie\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\ValueObject\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Infrastructure\Shared\Repository\AbstractRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

final class MovieRepository extends AbstractRepository implements MovieRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        parent::__construct($entityManager, $paginator);

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

    public function findAllPaginated(): PaginationInterface
    {
        $query = $this->repository->createQueryBuilder('o')->getQuery();

        return $this->paginator->paginate($query);
    }
}