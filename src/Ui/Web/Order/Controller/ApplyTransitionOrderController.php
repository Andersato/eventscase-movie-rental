<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\Order\Controller;

use Eventscase\MovieRental\Application\Order\Transition\ApplyOrderTransitionCommand;
use Eventscase\MovieRental\Domain\User\ValueObject\UserAuth;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

final class ApplyTransitionOrderController extends AbstractAppController
{

    public function apply(string $orderId, string $transition, AuthorizationChecker $security)
    {
        $this->commandBus->handle(
            new ApplyOrderTransitionCommand($orderId, $transition)
        );

        $this->addFlash('success', 'El estado se ha cambiado satisfactoriamente');

        if ($security->isGranted(UserAuth::ROLE_USER)) {
            return $this->redirectToRoute('rented_movies');
        }

        return $this->redirectToRoute('show_rental_movie_admin');
    }
}