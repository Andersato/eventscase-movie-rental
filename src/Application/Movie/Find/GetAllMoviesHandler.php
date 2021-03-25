<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Movie\Find;

use Eventscase\MovieRental\Application\Shared\Response\PaginationResponse;
use Eventscase\MovieRental\Application\Shared\Transform\PaginationDataTransformer;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;

final class GetAllMoviesHandler
{
    private $movieRepository;
    private $paginationDataTransformer;

    public function __construct(MovieRepositoryInterface $movieRepository, PaginationDataTransformer $paginationDataTransformer)
    {
        $this->movieRepository           = $movieRepository;
        $this->paginationDataTransformer = $paginationDataTransformer;
    }

    public function handle(GetAllMovieQuery $command): PaginationResponse
    {
        $pager = $this->movieRepository->findAllPaginated();

        $pager->setItemNumberPerPage($command->getLimit());
        $pager->setCurrentPageNumber($command->getPage());

        return $this->paginationDataTransformer->transform($pager);

    }
}