<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\Validator;

use Eventscase\MovieRental\Domain\Shared\Validator\Constraint\Constraint;

interface ValidatorInterface
{
    public function validate($value, Constraint $constraint): array;
}