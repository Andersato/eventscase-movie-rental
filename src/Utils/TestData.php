<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Utils;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\ValueObject\MovieId;
use Eventscase\MovieRental\Domain\Shared\ValueObject\Address;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\ValueObject\Email;
use Eventscase\MovieRental\Domain\User\ValueObject\IdentificationNumber;
use Eventscase\MovieRental\Domain\User\ValueObject\Phone;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;

class TestData
{
    public static function MoviesData(): array
    {
        return [
            new Movie(
                new MovieId(MovieId::random()->value()),
                'Película 1',
                'Descripción 1',
                5.50,
                2018,
                60,
                10
            ),
            new Movie(
                new MovieId(MovieId::random()->value()),
                'Película 2',
                'Descripción 2',
                3.50,
                2020,
                90,
                5
            )
        ];
    }

    public static function UsersData(): array
    {
        $encoder = new NativePasswordEncoder();

        return [
            new User(
                new UserId(UserId::random()->value()),
                new Address(
                    '12003',
                    '5',
                    'Calle 1',
                    'Ciudad 1'
                ),
                New Phone('690523147'),
                new Email(bin2hex(random_bytes(10)).'@gmail.com'),
                new IdentificationNumber('546566546C'),
                'User 1',
                'Apellido 1',
                $encoder->encodePassword('123456', null)
            ),
            new User(
                new UserId(UserId::random()->value()),
                new Address(
                    '12004',
                    '4',
                    'Calle 2',
                    'Ciudad 2'
                ),
                New Phone('690543147'),
                new Email(bin2hex(random_bytes(10)).'@gmail.com'),
                new IdentificationNumber('546566546D'),
                'User 2',
                'Apellido 2',
                $encoder->encodePassword('123456', null)
            )
        ];
    }
}