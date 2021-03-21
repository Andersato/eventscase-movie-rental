<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\Model;

use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;
use BornFree\TacticianDomainEvent\Recorder\EventRecorderCapabilities;
use Doctrine\Common\Collections\ArrayCollection;
use Eventscase\MovieRental\Domain\Shared\Traits\DateTimeTrait;
use Eventscase\MovieRental\Domain\Shared\ValueObject\Address;
use Eventscase\MovieRental\Domain\User\Event\UserWasCreated;
use Eventscase\MovieRental\Domain\User\ValueObject\Email;
use Eventscase\MovieRental\Domain\User\ValueObject\Phone;

final class User implements ContainsRecordedEvents
{
    use EventRecorderCapabilities;
    use DateTimeTrait;

    private $id;
    private $name;
    private $surnames;
    private $dni;
    private $phone;
    private $email;
    private $address;
    private $password;
    private $loginToken;
    private $roles;
    private $orders;


    public function __construct(UserId $id, Address $address, Phone $phone, Email $email, string $name, string $surnames, string $dni, string $password, string $loginToken, ArrayCollection $roles)
    {
        $this->id         = $id;
        $this->address    = $address;
        $this->phone      = $phone;
        $this->email      = $email;
        $this->name       = $name;
        $this->surnames   = $surnames;
        $this->dni        = $dni;
        $this->password   = $password;
        $this->loginToken = $loginToken;
        $this->roles      = $roles;
        $this->orders     = new ArrayCollection();
        $this->createdAt  = new \DateTimeImmutable();
        $this->updatedAt  = new \DateTimeImmutable();

        $this->record(new UserWasCreated($this));
    }

    public function getId(): UserId
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

    public function getDni(): string
    {
        return $this->dni;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getLoginToken(): string
    {
        return $this->loginToken;
    }

    public function getRoles(): ArrayCollection
    {
        return $this->roles;
    }
}