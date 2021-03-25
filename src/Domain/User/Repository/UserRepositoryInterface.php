<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\Repository;

use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;

interface UserRepositoryInterface
{
    public function find(UserId $id): ?User;

    public function findByUsername(string $username): ?User;

    public function store(User $user, bool $flush = false): void;
}