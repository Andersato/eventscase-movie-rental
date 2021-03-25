<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Create;

final class CreateOrderCommand
{
    private $id;
    private $username;
    private $items;

    public function __construct(string $id, string $username, array $items)
    {
        $this->id       = $id;
        $this->username = $username;
        $this->items    = $items;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getItems(): array
    {
        return $this->items;
    }

}