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
        $sideMenus = [
            'dashboard'     => url('user/dashboard'),
            'quick_sms'     => url('messaging/quick-sms'),
            'bulk_sms'      => url('messaging/bulk-sms'),
            'contacts',
            'groups',
            'sent_messages',
            'draft_messages',
        ];
        return create_object($sideMenus);
    }

}
