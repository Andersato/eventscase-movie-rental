<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\Validator;

use Eventscase\MovieRental\Domain\Shared\Validator\Constraint\Email;

class UserValidator
{
    public function validate(array $data): array
    {
        $globalErrors = [];
        $constraints = self::getConstraints();

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $constraints)) {
                $errors = null;
                foreach ($constraints as $constraint) {
                    foreach ($constraint as $constraintItem) {
                        $errors = $constraintItem->validate($value);
                    }
                }

                if (null !== $errors && 0 < count($errors)) {
                    $globalErrors[$key] = $errors;
                }
            }
        }

        return $globalErrors;
    }

    private static function getConstraints(): array
    {
        return [
            'email' => [
                new Email()
            ]
        ];
    }
}