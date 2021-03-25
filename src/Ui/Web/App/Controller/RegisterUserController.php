<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Ui\Web\App\Controller;

use Eventscase\MovieRental\Application\Shared\Dto\Address\Address;
use Eventscase\MovieRental\Application\User\Create\RegisterUserCommand;
use Eventscase\MovieRental\Domain\User\Exception\UserAlreadyExistsException;
use Eventscase\MovieRental\Ui\Web\Shared\Controller\AbstractAppController;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class RegisterUserController extends AbstractAppController
{
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {

            try{
                $this->commandBus->handle(
                    new RegisterUserCommand(
                        Uuid::uuid1()->toString(),
                        $request->request->get('name'),
                        $request->request->get('surnames'),
                        $request->request->get('email'),
                        $request->request->get('identificationNumber'),
                        $request->request->get('password'),
                        $request->request->get('phone'),
                        new Address(
                            $request->request->get('zipcode'),
                            $request->request->get('houseNumber'),
                            $request->request->get('street'),
                            $request->request->get('city')
                        )
                    )
                );

                return $this->redirectToRoute('user_login');
            } catch (UserAlreadyExistsException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->render('App/register.html.twig', []);
    }
}