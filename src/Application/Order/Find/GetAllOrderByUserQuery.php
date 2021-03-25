<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Find;

use Eventscase\MovieRental\Application\Shared\Dto\Pagination\PaginationRequest;

final class GetAllOrderByUserQuery extends PaginationRequest
{
    private $username;

    public function __construct(string $username)
    {
        parent::__construct();

        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}