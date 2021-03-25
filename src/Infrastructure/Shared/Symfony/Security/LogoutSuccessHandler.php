<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Shared\Symfony\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

final class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    private $router;
    private $tokenStorage;

    public function __construct(RouterInterface $router, TokenStorageInterface $tokenStorage)
    {
        $this->router       = $router;
        $this->tokenStorage = $tokenStorage;
    }

    public function onLogoutSuccess(Request $request)
    {
        $goTo = $this->router->generate('front_homepage');

        //@TODO Si hubiese que hacer algo con el usuario después del logout, se haría aquí

        return new RedirectResponse($goTo);
    }
}