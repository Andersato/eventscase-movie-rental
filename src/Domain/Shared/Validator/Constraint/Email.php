<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\Validator\Constraint;

use Eventscase\MovieRental\Domain\Shared\Validator\MovieRentalValidator;

final class Email extends Constraint
{
    protected $message    = 'This value is not in valid format.';

    protected function allowOptions(): array
    {
        return [
            self::MESSAGE_OPTION
        ];
    }

    public function validate($value): array
    {
        $errors = [];

        $error = MovieRentalValidator::email($value, $this->message);

        if (null !== $error) {
            $errors[] = $error;
        }

        return $errors;
    }
}