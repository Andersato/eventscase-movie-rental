<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Shared\Response;

final class PaginationResponse
{
    private $page;
    private $limit;
    private $numPages;
    private $total;
    private $items;

    public function __construct(int $page, int $limit, int $numPages, int $total, array $items)
    {
        $this->page     = $page;
        $this->limit    = $limit;
        $this->numPages = $numPages;
        $this->total    = $total;
        $this->items    = $items;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getNumPages(): int
    {
        return $this->numPages;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}