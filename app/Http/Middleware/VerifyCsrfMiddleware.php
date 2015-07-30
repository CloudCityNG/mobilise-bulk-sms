<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfMiddleware extends VerifyCsrfToken {

    public function handle($request, Closure $next)
    {
        if ($this->isReading($request) || $this->excludedRoutes($request) || $this->tokensMatch($request))
        {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }


    protected function excludedRoutes($request)
    {
        $routes = [
            'dlr-collector',
        ];

        foreach ($routes as $route)
            if ($request->is($route))
                return true;

        return false;
    }
} 