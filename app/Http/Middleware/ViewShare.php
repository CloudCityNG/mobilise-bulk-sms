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
        view()->share('currentUser',    Auth::User());
        view()->share('sideMenu',       $this->sideMenus());
        view()->share('supportMenu',    $this->supportMenus());
        view()->share('sitemap',        $this->sitemap());
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

            'support'   => url('app/contact-us'),


        ];
        return create_object($sideMenus);
    }

    private function supportMenus()
    {
        $menus = [
            //customer support
            'about_us'          => url('app/about-us'),
            'contact_us'        => url('app/contact-us'),
            'sitemap'           => url('app/sitemap'),
            //'customer_support'  => url('app/customer-support'),
            'terms'             => url('app/terms'),
        ];
        return create_object($menus);
    }


    private function sitemap()
    {
        $map = [

            'messaging'     => [
                'dashboard' => $this->sideMenus()->dashboard,
                'quic_sms'  => $this->sideMenus()->quick_sms,
                'sent_sms'  => $this->sideMenus()->sent_messages,
                'draft_sms' => $this->sideMenus()->draft_messages,
            ],

            'user_profile'  => [
                'login'                 => url('user/login'),
                'login_with_google'     => url('Oauth/Authenticate/google'),
                'login_with_facebook'   => url('Oauth/Authenticate/facebook'),
                'register'              => url('user/register'),
                'change_password'       => url('settings/account'),
                'lost_password'         => url('password/email'),
            ],

            'transactions'  => [
                'purchase_order'    => url('settings/orders'),
                'payments'          => url('settings/payments'),
                'credit_purchase'   => url('user/credit-purchase'),
            ],

            'quic_sms'      => [
                'about_us'      => url('app/about-us'),
                'contact_us'    => url('app/contact-us'),
                'sitemap'       => url('app/sitemap'),
                'terms'         => url('app/terms'),
            ],
        ];

        return create_object($map);
    }

}
