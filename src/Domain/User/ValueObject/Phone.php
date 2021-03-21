<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\ValueObject;

final class Phone
{
    private $value;

    public function __construct(string $value)
    {
        $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}