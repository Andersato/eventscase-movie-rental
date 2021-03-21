<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\Validator;

final class MovieRentalValidator
{
    public static function email(string $value, string $message = null): ?string
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL) === false)
        {
            return $message ?? 'This value is not in valid format.';
        }

        return null;
    }

    public static function greaterThan($value, string $message = null): ?string
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL) === false)
        {
            return $message ?? 'This value is not in valid format.';
        }

        return null;
    }
}