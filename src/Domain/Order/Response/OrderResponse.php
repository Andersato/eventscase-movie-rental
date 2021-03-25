<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Order\Response;

use Eventscase\MovieRental\Domain\Shared\Transform\DataResponse;

final class OrderResponse implements DataResponse
{
    private $id;
    private $price;
    private $status;
    private $createdAt;
    private $endDate;
    private $orderLines;

    public function __construct(string $id, float $price, string $status, \DateTimeImmutable $createdAt, ?\DateTime $endDate, array $orderLines = [])
    {
        $this->id         = $id;
        $this->price      = $price;
        $this->status     = $status;
        $this->createdAt  = $createdAt;
        $this->endDate    = $endDate;
        $this->orderLines = $orderLines;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function getOrderLines(): array
    {
        return $this->orderLines;
    }

}