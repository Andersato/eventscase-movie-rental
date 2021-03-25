<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Movie\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Eventscase\MovieRental\Domain\Movie\ValueObject\MovieId;
use Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType;

class MovieIdType extends UuidBinaryOrderedTimeType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new MovieId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return parent::convertToDatabaseValue($value, $platform);
    }
}