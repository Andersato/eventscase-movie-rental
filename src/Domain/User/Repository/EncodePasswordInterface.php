<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\Repository;


interface EncodePasswordInterface
{
    public function encoder(string $password): string;

    public function isPasswordValid(string $passwordEncoded, string $plainPassword): bool;
}