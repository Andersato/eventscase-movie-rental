<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    private $value;

    public function __construct(UuidInterface $value = null)
    {
        //$this->ensureIsValidUuid($value);
        $this->value = $value ?? RamseyUuid::uuid1();
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid1());
    }

    public function value(): UuidInterface
    {
        return $this->value;
    }

    public static function fromString(string $value): UuidInterface
    {
        return RamseyUuid::fromString($value);
    }

    //private function ensureIsValidUuid($id): void
    //{
    //    if (!RamseyUuid::isValid($id)) {
    //        throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
    //    }
    //}

    public function __toString()
    {
        return $this->value()->toString();
    }
}