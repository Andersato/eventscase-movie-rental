<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Model;

use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;
use BornFree\TacticianDomainEvent\Recorder\EventRecorderCapabilities;
use Doctrine\Common\Collections\ArrayCollection;
use Eventscase\MovieRental\Domain\Order\Event\OrderStatusHasChanged;
use Eventscase\MovieRental\Domain\Order\Event\OrderWasCreated;
use Eventscase\MovieRental\Domain\Order\Workflow\OrderStatusWorkflow;
use Eventscase\MovieRental\Domain\Shared\Traits\DateTimeTrait;
use Eventscase\MovieRental\Domain\Shared\ValueObject\Address;
use Eventscase\MovieRental\Domain\User\Model\User;

final class Order implements ContainsRecordedEvents
{
    use EventRecorderCapabilities;
    use DateTimeTrait;

    public const STATUS_RENTEND    = 'rentend';
    public const STATUS_CANCELLED  = 'cancelled';
    public const STATUS_SENT       = 'sent';
    public const STATUS_RECEIVED   = 'received';
    public const STATUS_UNRECEIVED = 'unreceived';
    public const STATUS_DELIVERED  = 'delivered';
    public const STATUS_RETURNED   = 'returned';

    public const TRANSITION_TO_RENTEND    = 'to_rentend';
    public const TRANSITION_TO_CANCELLED  = 'to_cancelled';
    public const TRANSITION_TO_SENT       = 'to_sent';
    public const TRANSITION_TO_RECEIVED   = 'to_received';
    public const TRANSITION_TO_UNRECEIVED = 'to_unreceived';
    public const TRANSITION_TO_DELIVERED  = 'to_delivered';
    public const TRANSITION_TO_RETURNED   = 'to_returned';

    private $id;
    private $orderId;
    private $price;
    private $address;
    private $status;
    private $endDate;
    private $user;
    private $orderLines;

    public function __construct(OrderId $id, Address $address, User $user, \DateTime $endDate, float $price)
    {
        $this->id      = $id;
        $this->address = $address;
        $this->user    = $user;
        $this->endDate = $endDate;
        $this->price   = $price;
        $this->status  = self::STATUS_RENTEND;
        $this->orderLines = new ArrayCollection();
        $this->createdAt  = new \DateTimeImmutable();
        $this->updatedAt  = new \DateTimeImmutable();

        $this->record(new OrderWasCreated($this));
    }

    public function changeStatus(string $transition)
    {
        $oldStatus = $this->getStatus();
        $orderStatusWorkflow = new OrderStatusWorkflow();

        $orderStatusWorkflow->apply($this, $transition);

        $this->record(new OrderStatusHasChanged($this, $oldStatus, $this->getStatus()));

        return $this;
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}