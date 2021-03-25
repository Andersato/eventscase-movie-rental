<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Repository;

use Eventscase\MovieRental\Domain\Order\Model\Order;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface OrderRepositoryInterface
{
    public function find(OrderId $id): ?Order;

    public function findAllByUserPaginated(string $username): PaginationInterface;

    public function findAllPaginated(): PaginationInterface;

    public function store(Order $order, bool $flush = false): void;
}