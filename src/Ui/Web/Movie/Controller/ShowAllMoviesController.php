<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\Movie\Controller;

use Eventscase\MovieRental\Application\Movie\Find\GetAllMoviesQuery;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Symfony\Component\HttpFoundation\Request;

final class ShowAllMoviesController extends AbstractAppController
{
    public function show(Request $request)
    {
        $pager = $this->commandBus->handle(
            new GetAllMoviesQuery()
        );

        return $this->render('Movie/show_movies.html.twig', [
            'pager' => $pager
        ]);
    }
}