<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Find;

use Eventscase\MovieRental\Application\Shared\Response\PaginationResponse;
use Eventscase\MovieRental\Application\Shared\Transform\PaginationDataTransformer;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;
use Eventscase\MovieRental\Domain\User\Exception\UserNotFoundException;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;

final class GetAllOrderByUserHandler
{
    private $userRepository;
    private $orderRepository;
    private $paginationDataTransformer;

    public function __construct(UserRepositoryInterface $userRepository,OrderRepositoryInterface $orderRepository, PaginationDataTransformer $paginationDataTransformer)
    {
        $this->userRepository            = $userRepository;
        $this->orderRepository           = $orderRepository;
        $this->paginationDataTransformer = $paginationDataTransformer;
    }

    public function handle(GetAllOrderByUserQuery $command): PaginationResponse
    {
        $user = $this->userRepository->findByUsername($command->getUsername());

        if (null === $user) {
            throw new UserNotFoundException('EL usuario no existe');
        }

        $pager = $this->orderRepository->findAllByUserPaginated($user->getUserAuth()->getEmail());

        $pager->setItemNumberPerPage($command->getLimit());
        $pager->setCurrentPageNumber($command->getPage());

        return $this->paginationDataTransformer->transform($pager);
    }
}