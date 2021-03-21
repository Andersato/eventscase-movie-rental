<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Shared\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository
{
    protected $entityManager;
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}