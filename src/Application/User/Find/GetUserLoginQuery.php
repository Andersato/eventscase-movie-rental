<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\User\Find;

final class GetUserLoginQuery
{
    private $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}