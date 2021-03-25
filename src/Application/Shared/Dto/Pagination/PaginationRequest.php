<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Shared\Dto\Pagination;

abstract class PaginationRequest
{
    public const LIMIT = 50;
    public const PAGE  = 1;

    private $limit;
    private $page;

    //@TODO faltaría implementar variable de ordenación y de filtros

    public function __construct(int $limit = null, int $page = null)
    {
        $this->limit = $limit ?? self::LIMIT;
        $this->page  = $page  ?? self::PAGE;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}