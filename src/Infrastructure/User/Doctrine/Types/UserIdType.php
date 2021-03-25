<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\User\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType;

class UserIdType extends UuidBinaryOrderedTimeType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new UserId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return parent::convertToDatabaseValue($value, $platform);
    }
}