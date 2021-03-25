<?php

namespace Eventscase\MovieRental\Infrastructure\Shared\Symfony\Security;

use Doctrine\ORM\EntityManagerInterface;
use Eventscase\MovieRental\Application\User\Find\GetUserLoginQuery;
use Eventscase\MovieRental\Domain\User\Repository\EncodePasswordInterface;
use Eventscase\MovieRental\Domain\User\ValueObject\UserAuth;
use Eventscase\MovieRental\Infrastructure\User\Security\Authenticator;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'user_login';

    private $entityManager;
    private $urlGenerator;
    private $csrfTokenManager;
    private $commandBus;
    private $userPasswordEncoder;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, CommandBus $commandBus, EncodePasswordInterface $userPasswordEncoder, AuthorizationChecker $security)
    {
        $this->entityManager       = $entityManager;
        $this->urlGenerator        = $urlGenerator;
        $this->csrfTokenManager    = $csrfTokenManager;
        $this->commandBus          = $commandBus;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->security            = $security;
    }

    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email'      => $request->request->get('email'),
            'password'   => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);

        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->commandBus->handle(new GetUserLoginQuery($credentials['email']));

        if (!$user) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }

        return new Authenticator($user->getUserAuth());
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->userPasswordEncoder->isPasswordValid($user->getUserAuth()->getPassword(), $credentials['password']);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function getPassword($credentials): ?string
    {
        return $credentials['password'];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $route = 'rented_movies';

        //if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
        //    return new RedirectResponse($targetPath);
        //}
        if ($this->security->isGranted(UserAuth::ROLE_ADMIN)) {
            $route = 'show_movies_admin';
        }

        return new RedirectResponse($this->urlGenerator->generate($route));
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}