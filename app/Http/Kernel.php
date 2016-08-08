<?php namespace App\Http;

use App\Http\Middleware\SendSmsMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
    ];


    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
            'Illuminate\Session\Middleware\StartSession',
            'Illuminate\View\Middleware\ShareErrorsFromSession',
            \App\Http\Middleware\VerifyCsrfToken::class,
            'App\Http\Middleware\ViewShare',
        ],
    ];


    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'App\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
        'smscreditcheck' => SendSmsMiddleware::class,
        'bulksms.checkcredit' => 'App\Http\Middleware\BulkSmsMiddleware',
        'auth.admin' => 'App\Http\Middleware\AdminAuthenticationMiddleware',
        'auth.api' => \App\Http\Middleware\AuthenticateApiMiddleware::class,

    ];

}
