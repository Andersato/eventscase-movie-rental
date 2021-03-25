<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\ValueObject;

final class Phone
{
    private $value;

    public function __construct(string $value)
    {
        //Do validation

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}