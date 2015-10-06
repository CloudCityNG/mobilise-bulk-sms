<?php
namespace App\Http\Middleware;

use App\Repository\SmsCreditRepository;
use Closure;

class SendSmsMiddleware
{

    const NO_CREDIT = 0;
    const NO_CREDIT_TEXT = 'You do not have enough credits to send SMS. Please buy more.';

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
        //dd($user_credit);
        //if NO CREDIT at all handle
        if ($user_credit <= self::NO_CREDIT) {
            if ($request->ajax()) {
                return response()->json(['credit' => [self::NO_CREDIT_TEXT]], 422);
            }
            //@TODO set a sms/home route
            flash()->info(self::NO_CREDIT_TEXT);
            return redirect()->back()->withInput();
        }

        //calculate TOTAL CREDIT from no of recipients & sms pages.
        $message = $request->get('message');
        $recipients = $request->get('recipients');
        $total_units = SmsCreditRepository::getSmsBill($recipients, $message);

        if ($user_credit < $total_units) {
            if ($request->ajax()) {
                return response()->json(['credit' => [self::NO_CREDIT_TEXT]], 422);
            }
            flash()->info(self::NO_CREDIT_TEXT);
            return redirect()->back()->withInput();
        }

        return $next($request);
    }

}
