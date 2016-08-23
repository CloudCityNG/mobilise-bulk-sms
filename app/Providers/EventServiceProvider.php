<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewUserRegistered' => [
            'App\Listeners\NewUserRegisteredListener',
        ],
        'App\Events\UserLoggedIn' => [
            'App\Listeners\UserLoggedInListener',
        ],
        'App\Events\SmsJobStarted' => [
            'App\Listeners\SmsJobStartedListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }

}
