<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\ValueObject;

use Eventscase\MovieRental\Domain\Shared\Validator\MovieRentalValidator;
use Eventscase\MovieRental\Domain\Shared\ValueObject\Exception\InvalidEmailException;

final class Email
{
    private $value;

    public function __construct(string $value)
    {
        $error = MovieRentalValidator::email($value);

        if (null !== $error) {
            throw new InvalidEmailException($error);
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}