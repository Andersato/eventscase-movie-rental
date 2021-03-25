<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\User\Find;

use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;

final class GetUserLoginHandler
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserLoginQuery $command): ?User
    {
        return $this->userRepository->findByUsername($command->getUsername());
    }
}