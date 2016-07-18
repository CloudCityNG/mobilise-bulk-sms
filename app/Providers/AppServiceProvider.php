<?php namespace App\Providers;

use App\Validation\ScheduleValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Validator::extend('auth', 'App\Validation\ApiValidators@validateAuth');
		Validator::extend('compare_time', 'App\Validation\ApiValidators@compareTime');

        Validator::resolver(function($translator, $data, $rules, $messages){
            return new ScheduleValidator($translator, $data, $rules, $messages);
        });

	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}
}
