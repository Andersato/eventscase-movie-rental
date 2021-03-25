<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\User\EventListener;

use Eventscase\MovieRental\Application\User\Mail\SendMailCreateUserCommand;
use Eventscase\MovieRental\Domain\User\Event\UserWasCreated;
use League\Tactician\CommandBus;

final class UserWasCreatedListener
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function onUserWasCreated(UserWasCreated $event)
    {
        $user = $event->getUser();

        $this->commandBus->handle(
            new SendMailCreateUserCommand($user->getId()->value()->toString())
        );
    }
}