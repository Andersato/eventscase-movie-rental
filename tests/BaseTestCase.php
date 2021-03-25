<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Tests;

use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Utils\TestData;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseTestCase extends WebTestCase
{
    /** @var KernelBrowser */
    protected $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function get(string $id)
    {
        return static::$container->get($id);
    }

    protected function addTestMovies(): array
    {
        /** @var MovieRepositoryInterface $movieRepository */
        $movieRepository = $this->get(MovieRepositoryInterface::class);
        $ids = [];

        /** @var Movie $movie */
        foreach (TestData::MoviesData() as $movie) {
            $movieRepository->store($movie, true);
            $ids[] = $movie->getId()->value()->toString();
        }

        return $ids;
    }

    protected function addTestUsers(): array
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = $this->get(UserRepositoryInterface::class);
        $emails = [];

        /** @var User $user */
        foreach (TestData::UsersData() as $user) {
            $userRepository->store($user, true);
            $emails[] = $user->getUserAuth()->getEmail();
        }

        return $emails;
    }
}