<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Cli\Command;

use Eventscase\MovieRental\Application\User\Create\RegisterUserCommand;
use Eventscase\MovieRental\Domain\User\ValueObject\UserAuth;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAdminUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create_admin';

    private $commandBus;


    public function __construct(CommandBus $commandBus)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->commandBus      = $commandBus;

        parent::__construct();
    }

    public function configure()
    {
        $this
            ->addOption('email', null, InputOption::VALUE_REQUIRED, 'Email del usuario admin')
            ->addOption('password', null, InputOption::VALUE_REQUIRED, 'Contraseña del usuario admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $uuid = Uuid::uuid1();

        $this->commandBus->handle(
            new RegisterUserCommand(
                $uuid->toString(),
                'Admin',
                'Admin',
                $input->getOption('email'),
                '11111111',
                $input->getOption('password'),
                '652031478',
                null,
                [UserAuth::ROLE_ADMIN]
            )
        );

        $output->writeln(sprintf('<info>Se ha creado el administrador con email %s y password %s</info>',  $input->getOption('email'),  $input->getOption('password')));

        // return this if there was no problem running the command
        return 0;

        // or return this if some error happened during the execution
        // return 1;
    }
}