<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\Model;

use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;
use BornFree\TacticianDomainEvent\Recorder\EventRecorderCapabilities;
use Doctrine\Common\Collections\ArrayCollection;
use Eventscase\MovieRental\Domain\Shared\Traits\DateTimeTrait;
use Eventscase\MovieRental\Domain\Shared\ValueObject\Address;
use Eventscase\MovieRental\Domain\User\Event\UserWasCreated;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Eventscase\MovieRental\Domain\User\ValueObject\Email;
use Eventscase\MovieRental\Domain\User\ValueObject\IdentificationNumber;
use Eventscase\MovieRental\Domain\User\ValueObject\Phone;
use Eventscase\MovieRental\Domain\User\ValueObject\UserAuth;

class User implements ContainsRecordedEvents
{
    use EventRecorderCapabilities;
    use DateTimeTrait;

    private $id;
    private $name;
    private $surnames;
    private $identificationNumber;
    private $phone;
    private $address;
    private $loginToken;
    private $orders;
    private $userAuth;


    public function __construct(UserId $id, Phone $phone, Email $email, IdentificationNumber $identificationNumber, string $name, string $surnames, string $password, ?Address $address, array $roles = null)
    {
        $this->id                   = $id;
        $this->address              = $address;
        $this->phone                = $phone;
        $this->name                 = $name;
        $this->surnames             = $surnames;
        $this->identificationNumber = $identificationNumber;
        $this->loginToken           = base_convert(sha1($password.$email->__toString()), 16, 36);
        $this->orders               = new ArrayCollection();
        $this->userAuth             = new UserAuth($email->__toString(), $password, $roles);
        $this->createdAt            = new \DateTimeImmutable();
        $this->updatedAt            = new \DateTimeImmutable();

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

    public function getIdentificationNumber(): IdentificationNumber
    {
        return $this->identificationNumber;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function getUserAuth(): UserAuth
    {
        return $this->userAuth;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getLoginToken(): string
    {
        return $this->loginToken;
    }

    public function getOrders(): ArrayCollection
    {
        return $this->orders;
    }
}