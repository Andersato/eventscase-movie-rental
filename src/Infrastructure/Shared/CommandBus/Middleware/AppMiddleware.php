<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Shared\CommandBus\Middleware;

use League\Tactician\Middleware;

final class AppMiddleware implements Middleware
{

    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        dump('Hola Ander');

        $next($command);
    }
}