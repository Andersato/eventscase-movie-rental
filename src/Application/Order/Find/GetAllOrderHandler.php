<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Find;

use Eventscase\MovieRental\Application\Shared\Response\PaginationResponse;
use Eventscase\MovieRental\Application\Shared\Transform\PaginationDataTransformer;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;

final class GetAllOrderHandler
{
    private $orderRepository;
    private $paginationDataTransformer;

    public function __construct(OrderRepositoryInterface $ordeRepository, PaginationDataTransformer $paginationDataTransformer)
    {
        $this->orderRepository           = $ordeRepository;
        $this->paginationDataTransformer = $paginationDataTransformer;
    }

    public function handle(GetAllOrderQuery $command): PaginationResponse
    {
        $pager = $this->orderRepository->findAllPaginated();

        $pager->setItemNumberPerPage($command->getLimit());
        $pager->setCurrentPageNumber($command->getPage());

        return $this->paginationDataTransformer->transform($pager);

    }
}