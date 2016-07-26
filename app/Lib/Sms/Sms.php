<?php namespace App\Lib\Sms;



Abstract class Sms {

    protected $sender;
    protected $recipients;
    protected $message;
    protected $schedule;
    protected $flash;

    protected $error = [];

    abstract public function setSender($sender);


    abstract public function setRecipients($recipients);


    abstract public function setMessage($message);


    abstract protected function _prepare();

    public function send()
    {
        return $this->sendRequest(static::api_url, $this->_prepare());
    }


    protected function sendRequest($uri, $fields, $content_type='application/json')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: $content_type",'Accept:*/*']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

    }


} 