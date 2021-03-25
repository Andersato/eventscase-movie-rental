<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\User\Controller;

use Eventscase\MovieRental\Application\Order\Find\GetAllOrderByUserQuery;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Symfony\Component\HttpFoundation\Response;

final class RentedMoviesUserController extends AbstractAppController
{
    public function show(): Response
    {
        $user = $this->getUser();

        $pager = $this->commandBus->handle(
            new GetAllOrderByUserQuery($user->getUsername())
        );

        return $this->render('User/rented_movies.html.twig', [
            'pager' => $pager
        ]);
    }
}