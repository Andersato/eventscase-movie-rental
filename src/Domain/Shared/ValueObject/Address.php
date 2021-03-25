<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\ValueObject;

final class Address
{
    private $zipCode;
    private $houseNumber;
    private $street;
    private $city;

    public function __construct(
        string $zipCode,
        string $houseNumber,
        string $street,
        string $city
    ) {
        $this->zipCode = $zipCode;
        $this->houseNumber = $houseNumber;
        $this->street = $street;
        $this->city = $city;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}