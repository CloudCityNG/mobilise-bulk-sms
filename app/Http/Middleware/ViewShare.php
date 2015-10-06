<?php
namespace App\Http\Middleware;

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
        view()->share('sideMenu', $this->sideMenus());
		return $next($request);
	}


    private function sideMenus()
    {
        $sideMenu = [
            'dashboard'     => 'user/dashboard',
            'quick_sms'     => 'messaging/quick-sms',
            'bulk_sms'      => 'messaging/bulk-sms',
        ];
        return $sideMenu;
        //return json_decode(json_encode($sideMenu), false);
    }

}
