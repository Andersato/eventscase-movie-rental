<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Shared\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

abstract class AbstractRepository
{
    protected $entityManager;
    protected $repository;
    protected $paginator;

    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->paginator     = $paginator;
    }
}