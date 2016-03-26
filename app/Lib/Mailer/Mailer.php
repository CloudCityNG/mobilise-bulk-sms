<?php

namespace App\Lib\Mailer;

use Mail;

abstract class Mailer {

    public function sendTo($user, $subject, $view, $data=[])
    {
        Mail::queue($view, $data, function($message) use($user,$subject){

            if ( !empty($user->from) ) $message->from($user->from, $user->from_name);
            if ( !empty($user->cc) ) $message->cc($user->cc);
            if ( !empty($user->bcc) ) $message->bcc($user->bcc);

            $message->to($user->email)
                ->subject($subject);
        });
    }


    public function sendNow($user, $subject, $view, $data=[])
    {
        Mail::send($view, $data, function($message) use($user,$subject){

            if ( !empty($user->cc) )
                $message->cc($user->cc);

            $message->to($user->email)
                ->subject($subject);
        });
    }
}