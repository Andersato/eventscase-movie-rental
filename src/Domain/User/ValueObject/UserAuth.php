<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\User\ValueObject;

final class UserAuth
{

    public const ROLE_USER  = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    private const DEFAULT_ROLES = [
        self::ROLE_USER
    ];

    private $email;
    private $password;
    private $roles;

    public function __construct(string $email, string $password, array $roles = null)
    {
        $this->email    = $email;
        $this->password = $password;
        $this->roles    = $roles ?? self::DEFAULT_ROLES;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}