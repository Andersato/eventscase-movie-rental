<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Movie;

use Eventscase\MovieRental\Application\Shared\Dto\Address\Address;
use Eventscase\MovieRental\Application\User\Create\RegisterUserCommand;
use Eventscase\MovieRental\Domain\User\Exception\UserAlreadyExistsException;
use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Eventscase\MovieRental\Tests\BaseTestCase;

class UserRegisterTest extends BaseTestCase
{
    public function testUserRegister(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var UserRepositoryInterface $repository */
        $repository = $this->get(UserRepositoryInterface::class);

        /** @var EncodePasswordInterface $encoder */
        $encoder = $this->get(EncodePasswordInterface::class);

        $uuid = UserId::random()->value();
        $userId = new UserId($uuid);

        $passwordEncode = $encoder->encoder('123456');

        $command = new RegisterUserCommand(
            $uuid->toString(),
            'Anderson',
            'Sánchez Toledo',
            'anderson@gmail.com',
            '54654654564H',
            '123456',
            '6906823014',
            new Address(
                '12003',
                '56',
                'Calle de test',
                'Castellón'
            )
        );

        try {
            $commandBus->handle($command);

            $user = $repository->find($userId);
            $this->assertNotNull($user);

            $this->assertEquals($user->getId(), $command->getId());
            $this->assertEquals($user->getName(), $command->getName());
            $this->assertEquals($user->getSurnames(), $command->getSurnames());
            $this->assertEquals($user->getPhone(), $command->getPhone());
            $this->assertEquals($user->getUserAuth()->getEmail(), $command->getEmail());
            $this->assertTrue($encoder->isPasswordValid($passwordEncode, $command->getPassword()));
            $this->assertEquals($user->getAddress()->getZipCode(), $command->getAddress()->getZipCode());
            $this->assertEquals($user->getAddress()->getHouseNumber(), $command->getAddress()->getHouseNumber());
            $this->assertEquals($user->getAddress()->getStreet(), $command->getAddress()->getStreet());
            $this->assertEquals($user->getAddress()->getCity(), $command->getAddress()->getCity());
        } catch (UserAlreadyExistsException $alreadyExistsException) {
            $this->addToAssertionCount(1);
        }
    }
}