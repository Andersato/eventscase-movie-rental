<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\Validator;

final class MovieRentalValidator
{
    public static function email(string $value, string $message = null): ?string
    {
        // Igual habría que poner claves para las traducciones

        if(filter_var($value, FILTER_VALIDATE_EMAIL) === false)
        {
            return $message ?? 'Este valor no contiene un formato válido.';
        }

        return null;
    }
}