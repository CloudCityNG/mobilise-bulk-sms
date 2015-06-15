<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ViewShare {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        view()->share('currentUser', Auth::User());
		return $next($request);
	}

}
