<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Cli\Command;

use Eventscase\MovieRental\Application\Movie\Create\CreateMovieCommand;
use Eventscase\MovieRental\Application\Movie\Find\GetAllMoviesQuery;
use Eventscase\MovieRental\Application\Movie\Find\GetMovieQuery;
use Eventscase\MovieRental\Application\Order\Create\CreateOrderCommand;
use Eventscase\MovieRental\Application\Order\Dto\OrderLineItem;
use Eventscase\MovieRental\Application\Order\Find\GetAllOrderByUserQuery;
use Eventscase\MovieRental\Application\Shared\Dto\Address\Address;
use Eventscase\MovieRental\Application\User\Create\RegisterUserCommand;
use Eventscase\MovieRental\Application\User\Find\GetUserLoginQuery;
use Eventscase\MovieRental\Domain\Movie\Model\Movie;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Domain\User\Model\User;
use Eventscase\MovieRental\Domain\User\Model\UserId;
use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Eventscase\MovieRental\Domain\User\Repository\UserRepositoryInterface;
use Eventscase\MovieRental\Domain\User\Validator\UserValidator;
use Eventscase\MovieRental\Utils\TestData;
use Firebase\JWT\JWT;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TestCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:test';

    private $userValidator;
    private $commandBus;
    private $movieRepository;
    private $params;
    private $encoder;
    private $userRepository;


    public function __construct(UserValidator $userValidator, MovieRepositoryInterface $movieRepository, CommandBus $commandBus, ParameterBagInterface $bag, EncodePasswordInterface $encoder, UserRepositoryInterface $userRepository)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->userValidator   = $userValidator;
        $this->commandBus      = $commandBus;
        $this->movieRepository = $movieRepository;
        $this->params = $bag;
        $this->encoder = $encoder;
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    protected function configure()
    {

    }

    public function addTestMovies(): array
    {
        $ids = [];

        /** @var Movie $movie */
        foreach (TestData::MoviesData() as $movie) {
            $this->movieRepository->store($movie, true);
            $ids[] = $movie->getId()->value()->toString();
        }

        return $ids;
    }

    public function addTestUsers(): array
    {
        $emails = [];

        /** @var User $user */
        foreach (TestData::UsersData() as $user) {
            $this->userRepository->store($user, true);
            $emails[] = $user->getUserAuth()->getEmail();
        }

        return $emails;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $result = $this->commandBus->handle(new GetAllOrderByUserQuery('89f4be0e42f64d4d36e5@gmail.com'));

        dump($result);die;

        die;


        // return this if there was no problem running the command
        return 0;

        // or return this if some error happened during the execution
        // return 1;
    }
}