<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\User\Create;

use Eventscase\MovieRental\Application\Shared\Dto\Address\Address;

class RegisterUserCommand
{
    private $id;
    private $name;
    private $surnames;
    private $email;
    private $identificationNumber;
    private $password;
    private $phone;
    private $address;
    private $roles;

    public function __construct(string $id, string $name, string $surnames, string $email, string $identificationNumber, string $password, string $phone, ?Address $address, array $roles = null)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->surnames = $surnames;
        $this->email    = $email;
        $this->identificationNumber = $identificationNumber;
        $this->password = $password;
        $this->phone    = $phone;
        $this->address  = $address;
        $this->roles    = $roles;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurnames(): string
    {
        return $this->surnames;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }
}