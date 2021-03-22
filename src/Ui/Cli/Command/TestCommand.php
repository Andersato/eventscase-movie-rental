<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Cli\Command;

use Eventscase\MovieRental\Application\Movie\Create\CreateMovieCommand;
use Eventscase\MovieRental\Application\Movie\Query\GetMovieCommand;
use Eventscase\MovieRental\Domain\Movie\Model\MovieId;
use Eventscase\MovieRental\Domain\Movie\Repository\MovieRepositoryInterface;
use Eventscase\MovieRental\Domain\User\Validator\UserValidator;
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


    public function __construct(UserValidator $userValidator, MovieRepositoryInterface $movieRepository, CommandBus $commandBus, ParameterBagInterface $bag)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->userValidator   = $userValidator;
        $this->commandBus      = $commandBus;
        $this->movieRepository = $movieRepository;
        $this->params = $bag;

        parent::__construct();
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $uuidString = 'b1a324f2-8ae9-11eb-a709-0242c0a87003';
        $movie = $this->commandBus->handle(new GetMovieCommand($uuidString));

        $time = time();
        $key = $this->params->get('key_token');

        $token = array(
            'iat'  => $time, // Tiempo que inició el token
            'exp'  => $time + intval($this->params->get('time_expiration_token')), // Tiempo que expirará el token (+1 hora)
            'data' => [
                'id'    => $movie->getId(),
                'title' => $movie->getTitle(),
                'description' => $movie->getDescription(),
            ]
        );

        $jwt = JWT::encode($token, $key);

        $data = JWT::decode($jwt, $key, array('HS256'));

        dump($jwt);
        dump($data);die;

        $data = JWT::decode($jwt, $key, array('HS256'));

        var_dump($data);

        dump($movie);

        // return this if there was no problem running the command
        return 0;

        // or return this if some error happened during the execution
        // return 1;
    }
}