<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\App\Controller;

use Eventscase\MovieRental\Application\Movie\Find\GetAllMovieQuery;
use Eventscase\MovieRental\Application\Order\Create\CreateOrderCommand;
use Eventscase\MovieRental\Application\Order\Dto\OrderLineItem;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class ShowMoviesController extends AbstractAppController
{
    public function show(Request $request)
    {
        $pager = $this->commandBus->handle(
            new GetAllMovieQuery()
        );

        if ($request->isMethod('POST')) {
            $numMovies = count($request->request->get('quantities'));
            $movies = [];

            for ($i = 0; $i < $numMovies; $i++) {
                $quantity = intval($request->request->get('quantities')[$i]);

                if (0 < $quantity) {
                    $movies[] = new OrderLineItem(
                        Uuid::uuid1()->toString(),
                        $request->request->get('ids')[$i],
                        $quantity,
                        floatval($request->request->get('prices')[$i])
                    );
                }
            }

            $this->commandBus->handle(new CreateOrderCommand(
                Uuid::uuid1()->toString(),
                $this->getUser()->getUsername(),
                $movies
            ));
        }

        return $this->render('App/movies.html.twig', array(
            'pager' => $pager
        ));
    }
}