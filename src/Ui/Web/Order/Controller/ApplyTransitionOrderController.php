<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\Order\Controller;

use Eventscase\MovieRental\Application\Order\Transition\ApplyOrderTransitionCommand;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;

final class ApplyTransitionOrderController extends AbstractAppController
{
    public function apply(string $orderId, string $transition)
    {
        $this->commandBus->handle(
            new ApplyOrderTransitionCommand($orderId, $transition)
        );

        $this->addFlash('success', 'El estado se ha cambiado satisfactoriamente');

        return $this->redirectToRoute('rented_movies');
    }
}