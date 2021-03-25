<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\Shared\Controller;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractAppController extends AbstractController
{
    protected $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
}