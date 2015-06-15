<?php namespace App\Lib\Sms;



Abstract class Sms {

    abstract public function setSender($sender);


    abstract public function setRecipients($recipients);


    abstract public function setMessage($message);


    abstract public function send();


} 