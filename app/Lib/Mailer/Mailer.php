<?php

namespace App\Lib\Mailer;

use Mail;

abstract class Mailer {

    public function sendTo($user, $subject, $view, $data=[])
    {
        Mail::queue($view, $data, function($message) use($user,$subject){

            if ( !empty($user->cc) )
                $message->cc($user->cc);

            $message->to($user->email)
                ->subject($subject);
        });
    }
}