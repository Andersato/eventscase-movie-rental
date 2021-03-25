<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\Order\Controller;

use Eventscase\MovieRental\Application\Movie\Find\GetAllMoviesQuery;
use Eventscase\MovieRental\Application\Order\Find\GetAllOrderQuery;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Symfony\Component\HttpFoundation\Request;

final class ShowAllRentalMoviesController extends AbstractAppController
{
    public function show()
    {
        $pager = $this->commandBus->handle(
            new GetAllOrderQuery()
        );

        return $this->render('Order/rented_movies.html.twig', [
            'pager' => $pager
        ]);
    }
}