<?php

namespace App\Lib\Mailer;


class LogEmail extends Mailer {


    public function genericEmail($subject, $e)
    {
        $view = "emails.log.generic";
        $data = ['status_code'=> $e->getStatusCode(), 'trace'=>$e->getTraceAsString()];
        $subject = $subject;
        $user = (Object) ['email'=>'shegun.babs+developer@gmail.com'];

        return $this->sendTo($user, $subject, $view, $data);
    }

} 