<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Order\Create;

use Eventscase\MovieRental\Application\Order\Calculate\CalculateCostOrder;
use Eventscase\MovieRental\Domain\Movie\Exception\MovieNotFoundException;
use Eventscase\MovieRental\Domain\Movie\ValueObject\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Domain\Order\Model\Order;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;
use Eventscase\MovieRental\Domain\Order\Model\OrderLine;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderLineId;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;
use Eventscase\MovieRental\Domain\User\Exception\UserNotFoundException;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;

final class CreateOrderHandler
{
    private $userRepository;
    private $movieRepository;
    private $orderRepository;

    public function __construct(UserRepositoryInterface $userRepository, MovieRepositoryInterface $movieRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->userRepository  = $userRepository;
        $this->movieRepository = $movieRepository;
        $this->orderRepository = $orderRepository;
    }

    public function handle(CreateOrderCommand $command)
    {
        $user = $this->userRepository->findByUsername($command->getUsername());

        if (null === $user) {
            throw new UserNotFoundException('Usuario inexistente');
        }

        $calculateCost = new CalculateCostOrder();

        foreach ($command->getItems() as $item) {

            $movie = $this->movieRepository->find(new MovieId(MovieId::fromString($item->getMovieId())));

            if (null === $movie) {
                throw new MovieNotFoundException(sprintf('No existe la película %s', $item->getMovieId()));
            }

            $item->addMovie($movie);
            $calculateCost->addItem($item);
        }

        $order = new Order(
            new OrderId(OrderId::fromString($command->getId())),
            $user->getAddress(),
            $user,
            $calculateCost->calculate()
        );

        $orderLines = [];
        foreach ($command->getItems() as $item) {
            $orderLines[] = new OrderLine(
                new OrderLineId(OrderLineId::fromString($item->getId())),
                $order,
                $item->getMovie(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }

        $this->orderRepository->store($order, true);
    }

}