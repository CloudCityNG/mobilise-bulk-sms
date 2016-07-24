<?php

namespace App\Http\Middleware;

use Closure;

class checkSmsBillMiddleware
{

    const NO_CREDIT = 0;
    const NO_CREDIT_TEXT = 'You do not have enough credits to send SMS';
    const NO_CREDIT_TEXT_NAIRA = 'You do not have enough money to send message';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check user credits
        $user_credit = $request->user->smscredit->available_credit;

        //if zero credit
        if ($user_credit <= self::NO_CREDIT):
            if ($request->ajax()):
                return response()->json(['credit'=>[self::NO_CREDIT_TEXT]], 422);
            endif;
            flash()->error(self::NO_CREDIT_TEXT);
        return redirect()->back()->withInput();
        endif;

        return $next($request);
    }
}
