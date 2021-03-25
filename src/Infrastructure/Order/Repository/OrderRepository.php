<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Order\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Eventscase\MovieRental\Domain\Order\Model\Order;
use Eventscase\MovieRental\Domain\Order\ValueObject\OrderId;
use Eventscase\MovieRental\Domain\Order\Repository\OrderRepositoryInterface;
use Eventscase\MovieRental\Infrastructure\Shared\Repository\AbstractRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

final class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        parent::__construct($entityManager, $paginator);

        $this->repository = $entityManager->getRepository(Order::class);
    }

    public function find(OrderId $id): ?Order
    {
        /** @var Order $order */
        $order = $this->repository->find($id->value());

        return $order;
    }

    public function findAllByUserPaginated(string $username): PaginationInterface
    {
        $query = $this->repository->createQueryBuilder('o')
            ->join('o.user', 'u')
            ->where('u.userAuth.email = :email')
            ->setParameter('email', $username)
            ->getQuery();

        return $this->paginator->paginate($query);
    }

    public function findAllPaginated(): PaginationInterface
    {
        $query = $this->repository->createQueryBuilder('o')->getQuery();

        return $this->paginator->paginate($query);
    }

    public function store(Order $order, bool $flush = false): void
    {
        $this->entityManager->persist($order);

        if (true === $flush) {
            $this->entityManager->flush();
        }
    }
}