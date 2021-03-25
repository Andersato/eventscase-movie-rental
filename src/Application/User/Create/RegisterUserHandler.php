<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\User\Create;

use Eventscase\MovieRental\Domain\Shared\ValueObject\Address;
use Eventscase\MovieRental\Domain\User\Exception\UserAlreadyExistsException;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Domain\User\ValueObject\Email;
use Eventscase\MovieRental\Domain\User\ValueObject\IdentificationNumber;
use Eventscase\MovieRental\Domain\User\ValueObject\Phone;

final class RegisterUserHandler
{
    private $userRepository;
    private $encoder;

    public function __construct(UserRepositoryInterface $userRepository, EncodePasswordInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->encoder        = $encoder;
    }

    public function handle(RegisterUserCommand $command)
    {
        $address = null;
        if (null !== $command->getAddress()) {
           $address = new Address(
               $command->getAddress()->getZipCode(),
               $command->getAddress()->getHouseNumber(),
               $command->getAddress()->getStreet(),
               $command->getAddress()->getCity()
           );
        }

        $user = new User(
            new UserId(UserId::fromString($command->getId())),
            new Phone($command->getPhone()),
            new Email($command->getEmail()),
            new IdentificationNumber($command->getIdentificationNumber()),
            $command->getName(),
            $command->getSurnames(),
            $this->encoder->encoder($command->getPassword()),
            $address,
            $command->getRoles()
        );

        if (null !== $this->userRepository->findByUsername($command->getEmail())) {
            throw new UserAlreadyExistsException('Ya existe un usuario con este email');
        }

        $this->userRepository->store($user, true);
    }

}