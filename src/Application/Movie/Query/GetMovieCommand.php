<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Movie\Query;

final class GetMovieCommand
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}