<?php
namespace App\Http\Middleware;

use App\Http\Billing\SmsBilling;
use App\Repository\SmsCreditRepository;
use Closure;

class SendSmsMiddleware
{

    const NO_CREDIT = 0;
    const NO_CREDIT_TEXT = 'You do not have enough credits to send SMS. Please buy more.';
    /**
     * @var
     */
    private $billing;

    /**
     * SendSmsMiddleware constructor.
     */
    public function __construct(SmsBilling $billing)
    {
        $this->billing = $billing;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check user credit
        $user_credit = $request->user()->smscredit->available_credit;

        //if NO CREDIT at all handle
        if ($user_credit <= self::NO_CREDIT) {
            if ($request->ajax()) {
                return response()->json(['credit' => [self::NO_CREDIT_TEXT]], 422);
            }
            //@TODO set a sms/home route
            flash()->error(self::NO_CREDIT_TEXT);
            return redirect()->back()->withInput();
        }

        //calculate TOTAL CREDIT from no of recipients & sms pages.
        $message = $request->get('message');
        $recipients = $request->get('recipients');
        $total_units = $this->billing->getSmsUnitBill($recipients, $message);

        /**
         * Return low credit error if request is normal or AJAX
         */
        if ($user_credit < $total_units) {
            if ($request->ajax()) {
                return response()->json(['credit' => [self::NO_CREDIT_TEXT]], 422);
            }
            flash()->error(self::NO_CREDIT_TEXT);
            return redirect()->back()->withInput();
        }

        /**
         * Merge missing input into the request
         */
        if(!$request->exists('schedule'))
            $request->merge(['schedule'=>NULL]);
        if(!$request->exists('flash'))
            $request->merge(['flash'=>0]);

        return $next($request);
    }

}
