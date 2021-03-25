<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\User\Mail;

final class SendMailCreateUserCommand
{
    private $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}