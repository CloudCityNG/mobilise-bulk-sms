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
            //genral sidebar
            'dashboard'     => url('user/dashboard'),
            'quick_sms'     => url('messaging/quic-sms'),
            'bulk_sms'      => url('messaging/bulk-sms'),
            'contacts'      => url('contact/index'),
            'groups'        => '#',
            'sent_messages' => url('messaging/sent-sms'),
            'draft_messages'    => url('messaging/saved-sms'),

            //user sidebar
            'account_setting'   => url('settings/account'),
            'other_setting'     => url('settings/other-details'),
            'notifications'     => url('settings/notifications'),
            'orders'            => url('settings/orders'),
            'payments'          => url('settings/payments'),

            //user top dropdown menu
            'settings'  => url('settings/index'),
            'logout'    => url('user/logout'),
        ];
        return create_object($sideMenus);
    }

}
