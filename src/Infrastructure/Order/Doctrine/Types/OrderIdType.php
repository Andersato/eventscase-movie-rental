<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Order\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;
use Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType;

class OrderIdType extends UuidBinaryOrderedTimeType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new OrderId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return parent::convertToDatabaseValue($value, $platform);
    }
}