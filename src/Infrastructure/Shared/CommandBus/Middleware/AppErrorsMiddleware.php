<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Infrastructure\Shared\CommandBus\Middleware;

use League\Tactician\Middleware;

final class AppErrorsMiddleware implements Middleware
{
    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {

        // Esto era para probar a capturar los errores de validación y devolverlos serializados para
        // mostrarlos en el formulario, pero no he hecho las validaciones en conjunto
        // El middleware está deshabilitado

        $result = $next($command);

        return $result;
    }
}