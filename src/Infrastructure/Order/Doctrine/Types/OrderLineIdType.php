<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Order\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderLineId;
use Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType;

class OrderLineIdType extends UuidBinaryOrderedTimeType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new OrderLineId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return parent::convertToDatabaseValue($value, $platform);
    }
}