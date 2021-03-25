<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\Movie\Controller;

use Eventscase\MovieRental\Application\Movie\Create\CreateMovieCommand;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class CreateMovieController extends AbstractAppController
{
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->commandBus->handle(
                new CreateMovieCommand(
                    Uuid::uuid1()->toString(),
                    $request->request->get('title'),
                    $request->request->get('description'),
                    floatval($request->request->get('price')),
                    intval($request->request->get('year')),
                    intval($request->request->get('duration')),
                    intval($request->request->get('stock'))
                )
            );

            $this->addFlash('success', 'Película creada correctamente');

            return $this->redirectToRoute('show_movies_admin');
        }

        return $this->render('Movie/create_movie.html.twig', []);
    }
}