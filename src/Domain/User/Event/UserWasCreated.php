<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\Event;

use Eventscase\MovieRental\Domain\User\Model\User;

final class UserWasCreated
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}