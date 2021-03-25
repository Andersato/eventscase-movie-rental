<?php

namespace Eventscase\MovieRental\Infrastructure\User\Repository;

use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;

final class EncodePassword implements EncodePasswordInterface
{
    private $encoder;

    public function __construct(NativePasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    public function encoder(string $password): string
    {
        $encoded = $this->encoder->encodePassword($password, null);

        return $encoded;
    }

    public function isPasswordValid(string $passwordEncoded, string $plainPassword): bool
    {
        return $this->encoder->isPasswordValid($passwordEncoded, $plainPassword, null);
    }
}