<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests\Application\Movie;

use Eventscase\MovieRental\Application\Shared\Dto\Address\Address;
use Eventscase\MovieRental\Application\User\Create\RegisterUserCommand;
use Eventscase\MovieRental\Application\User\Find\GetUserLoginQuery;
use Eventscase\MovieRental\Domain\User\Exception\UserAlreadyExistsException;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Eventscase\MovieRental\Tests\BaseTestCase;
use Eventscase\MovieRental\Utils\TestData;

class UserLoginTest extends BaseTestCase
{
    public function testUserLogin(): void
    {
        $commandBus = $this->get('tactician.commandbus.default');

        /** @var UserRepositoryInterface $repository */
        $repository = $this->get(UserRepositoryInterface::class);

        $users = TestData::UsersData();
        /** @var User $user */
        $user = $users[0];

        $repository->store($user, true);

        $command = new GetUserLoginQuery($user->getUserAuth()->getEmail());

        $userResult = $commandBus->handle($command);
        $this->assertNotNull($userResult);

        $this->assertEquals($user->getUserAuth()->getEmail(), $userResult->getUserAuth()->getEmail());
        $this->assertEquals($user->getId(), $userResult->getId());
    }
}