<?php

namespace App\Lib\Sms;


use App\Lib\Services\Text\CharacterCounter;

class PenSmsApi extends Sms
{

    const api_url = 'http://107.20.199.106/api/v3/sendsms/json';
    const username = "shegun";
    const password = "password";


    public function __construct()
    {
        return $this;
    }


    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }


    public function setRecipients($recipients)
    {
        //set delimiter(s) (,)
        $allowedDelimiters = "/(,)+/";
        //split numbers according to set delimiters
        $to = preg_split($allowedDelimiters, $recipients, null, PREG_SPLIT_NO_EMPTY);
        //replace numbers dat start with 07/08/09 with 2347/2348/2349
        if (count($to) > 0) {
            $pattern = "/^(0)(7|8|9){1}([0-9]{9})/";
            $to = preg_replace($pattern, "234$2$3", array_unique($to));
        }
        foreach ($to as $numbers) {
            $this->recipients[]["gsm"] = $numbers;
        }
        return $this;
    }


    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }


    public function setSchedule($dateTime)
    {
        if (empty($dateTime))
            return $this;
        $now = new \DateTime("now", new \DateTimeZone('UTC'));
        $schedule = new \DateTime($dateTime);
        $schedule->setTimezone(new \DateTimeZone('UTC'));
        if ($schedule->getTimestamp() <= $now->getTimestamp()):
            return $this;
        elseif ($schedule->getTimestamp() > $now->getTimestamp()):
            $interval = $now->diff($schedule);
            $this->schedule = $interval->format('%a' . 'd' . '%h' . 'h' . '%i' . 'm');
            return $this;
        endif;
        return $this;
    }


    public function flash($flash)
    {
        if ($flash)
            $this->flash = true;
        return $this;
    }


    public function setAuth()
    {
        return ['username' => static::username, 'password' => static::password];
    }


    protected function _prepare()
    {
        $authentication['authentication'] = $this->setAuth();

        $messages = [
            'sender' => $this->sender,
            'text' => $this->message,
            'recipients' => $this->recipients,
        ];

        //if message is more than 160xters add longsms
        if (CharacterCounter::countPage($this->message)->pages > 1)
            $messages = array_merge($messages, ['type' => 'longSMS']);

        //if schedule add it
        if ($this->schedule)
            $messages = array_merge([$messages, ['sendDateTime' => $this->schedule]]);


        if ($this->flash)
            $messages = array_merge(['flash' => 1, $messages]);

        $authentication['messages'] = [
            $messages
        ];

        return json_encode($authentication);
    }
}