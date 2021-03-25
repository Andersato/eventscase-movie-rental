<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Movie;

use Eventscase\MovieRental\Application\Shared\Dto\Address\Address;
use Eventscase\MovieRental\Application\User\Create\RegisterUserCommand;
use Eventscase\MovieRental\Domain\User\Exception\UserAlreadyExistsException;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Eventscase\MovieRental\Tests\BaseTestCase;
use Eventscase\MovieRental\Utils\TestData;

class UserRegisterTest extends BaseTestCase
{
    public function testUserRegisterValid(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var UserRepositoryInterface $repository */
        $repository = $this->get(UserRepositoryInterface::class);

        /** @var EncodePasswordInterface $encoder */
        $encoder = $this->get(EncodePasswordInterface::class);

        $users = TestData::UsersData();
        /** @var User $user */
        $user = $users[0];

        $passwordEncode = $encoder->encoder('123456');

        $command = new RegisterUserCommand(
            $user->getId()->value()->toString(),
            $user->getName(),
            $user->getSurnames(),
            $user->getUserAuth()->getEmail(),
            $user->getIdentificationNumber()->__toString(),
            '123456',
            $user->getPhone()->__toString(),
            new Address(
                $user->getAddress()->getZipCode(),
                $user->getAddress()->getHouseNumber(),
                $user->getAddress()->getStreet(),
                $user->getAddress()->getCity()
            )
        );

        $commandBus->handle($command);

        $userResult = $repository->find($user->getId());
        $this->assertNotNull($userResult);

        $this->assertEquals($userResult->getId(), $command->getId());
        $this->assertEquals($userResult->getName(), $command->getName());
        $this->assertEquals($userResult->getSurnames(), $command->getSurnames());
        $this->assertEquals($userResult->getPhone(), $command->getPhone());
        $this->assertEquals($userResult->getUserAuth()->getEmail(), $command->getEmail());
        $this->assertTrue($encoder->isPasswordValid($passwordEncode, $command->getPassword()));
        $this->assertEquals($userResult->getAddress()->getZipCode(), $command->getAddress()->getZipCode());
        $this->assertEquals($userResult->getAddress()->getHouseNumber(), $command->getAddress()->getHouseNumber());
        $this->assertEquals($userResult->getAddress()->getStreet(), $command->getAddress()->getStreet());
        $this->assertEquals($userResult->getAddress()->getCity(), $command->getAddress()->getCity());
    }

    public function testUserRegisterExisting(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var UserRepositoryInterface $repository */
        $repository = $this->get(UserRepositoryInterface::class);

        $users = TestData::UsersData();
        /** @var User $user */
        $user = $users[0];

        $repository->store($user, true);

        $command = new RegisterUserCommand(
            $user->getId()->value()->toString(),
            $user->getName(),
            $user->getSurnames(),
            $user->getUserAuth()->getEmail(),
            $user->getIdentificationNumber()->__toString(),
            '123456',
            $user->getPhone()->__toString(),
            new Address(
                $user->getAddress()->getZipCode(),
                $user->getAddress()->getHouseNumber(),
                $user->getAddress()->getStreet(),
                $user->getAddress()->getCity()
            )
        );

        $this->expectException(UserAlreadyExistsException::class);

        $commandBus->handle($command);
    }
}