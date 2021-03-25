<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\User\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\ValueObject\UserId;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Infrastructure\Shared\Repository\AbstractRepository;
use Knp\Component\Pager\PaginatorInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        parent::__construct($entityManager, $paginator);

        $this->repository = $entityManager->getRepository(User::class);
    }

    public function find(UserId $id): ?User
    {
        /** @var User|null $user */
        $user = $this->repository->find($id->value());

        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        /** @var User|null $user */
        $user = $this->repository->findOneBy(array(
            'userAuth.email' => $username
        ));

        return $user;
    }

    public function store(User $user, bool $flush = false): void
    {
        $this->entityManager->persist($user);

        if (true === $flush) {
            $this->entityManager->flush();
        }
    }
}