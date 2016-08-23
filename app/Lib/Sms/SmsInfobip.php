<?php
namespace App\Lib\Sms;


use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Lib\Services\Text\CharacterCounter;
use Carbon\Carbon;

class SmsInfobip extends Sms
{

    const api_url = 'http://api.infobip.com/api/v3/sendsms/json';
    const username = 'mobiliseafrica';
    const password = '124!Nigeria';

    protected $sender;
    protected $recipients;
    protected $message;
    protected $schedule;
    protected $flash;

    protected $error = [];
    /**
     * @var PhoneUtil
     */
    private $phoneUtil;

    public function __construct(PhoneUtil $phoneUtil)
    {
        $this->phoneUtil = $phoneUtil;
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

        /**
         * Remove duplicates and invalid numbers
         */
        $to = array_unique($to);
        foreach ($to as $number) {
            try{
                $this->phoneUtil->number($number);
                if ($this->phoneUtil->isValid()):
                    $this->recipients[]["gsm"] = $number;
                endif;
            } catch(\Exception $e) {
                //continue
            }
        }
        return $this;
    }


    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }


    public function setSchedule($datetime)
    {
        if (empty($datetime)) {
            return $this;
        }
        $now = new \DateTime("now", new \DateTimeZone('UTC'));
        $nowTimestamp = $now->getTimestamp();

        //value should be high higher.
        //this should be a later time
        $future = new \DateTime($datetime);
        $future = $future->setTimezone(new \DateTimeZone('UTC'));
        $futureTimestamp = $future->getTimestamp();

        if ((int)$futureTimestamp > (int)$nowTimestamp + 60):
            $interval = $now->diff($future);
            $this->schedule = $interval->format('%a' . 'd' . '%h' . 'h' . '%i' . 'm');
            return $this;
        endif;

        return $this;

//        $now = (new \DateTime());
//        $schedule = (new \DateTime($datetime));
//        if ($schedule->getTimestamp() <= $now->getTimestamp())
//            return $this;
//        if ($schedule->getTimestamp() > $now->getTimestamp()) {
//            $interval = $now->diff($schedule);
//            $this->schedule = $interval->format('%a' . 'd' . '%h' . 'h' . '%i' . 'm');
//            return $this;
//        }
//        return $this;
    }


    public function flash($flash)
    {
        if ($flash)
            $this->flash = true;
        return $this;
    }


    private function setAuth()
    {
        return ['username' => self::username, 'password' => self::password];
    }

    public function _prepare()
    {
        //gather auth details
        $authentication['authentication'] = $this->setAuth();

        //make the messages array with defaults
        $messages = [
            'sender' => $this->sender,
            'text' => $this->message,
            'recipients' => $this->recipients,
        ];

        //if message is more than 160, then add longsms
        if (CharacterCounter::countPage($this->message)->pages > 1) {
            $messages = array_merge($messages, ['type' => 'longSMS']);
        }

        //if schedule exists add it
        if ($this->schedule) {
            $messages = array_merge($messages, ['sendDateTime' => $this->schedule]);
        }


        //if flash add it
        if ($this->flash) {
            $messages = array_merge(['flash' => 1], $messages);
        }

        //compose all together.
        $authentication["messages"] = [
            $messages,
        ];

        return json_encode($authentication);
    }


    public function send()
    {
        //for testing purpose only
        //return '{"results": [ {"status":"-22","messageid":"","destination":"000000000000"}, {"status":"0","messageid":"155060816184838810","destination":"2348099450165"} ]}';
        return $this->sendRequest(self::api_url, $this->_prepare());
    }
}