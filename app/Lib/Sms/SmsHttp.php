<?php namespace App\Lib\Sms;



class SmsHttp extends Sms {

    const api = 'http://www.kudisms.net/components/com_spc/smsapi.php';
    const sms_username = 'shegun.babs';
    const sms_password = 'segesseges!@#';

    private $_senderId, $_recipients, $_message,
            $_schedule = null,

            $_error, $_errorMSG, $_eCode,

            $_success=null, $_usedCredit
    ;

    public function setSender($sender)
    {
        $this->_senderId = $sender;
        return $this;
    }

    /** Prepare recipients as string of comma separated MSISDNs
     * @param $recipients
     * @internal param $r
     * @return $this
     */
    public function setRecipients($recipients)
    {
        //set delimiters (, & white space)
        $allowedDelimiters = "/(,|\s)+/";
        //split numbers according to set delimiters
        $to = preg_split($allowedDelimiters, $recipients, null, PREG_SPLIT_NO_EMPTY);
        //replace numbers dat start with 07/08/09 with 2347/2348/2349
        if ( count($to) > 0 )
        {
            $pattern = "/^(0)(7|8|9){1}([0-9]{9})/";
            $to = preg_replace($pattern, "234$2$3", array_unique($to));
        }
        //delimit with commas back
        $this->_recipients = implode(", ", $to);
        return $this;
    }

    public function setMessage($msg)
    {
        $this->_message = $msg;
        return $this;
    }

    public function scheduleMessage($timestamp=null)
    {
        if ( is_null($timestamp) || empty($timestamp) ) return $this;

        $this->_schedule = date("Y-m-d H:i:s", $timestamp);
        return $this;
    }

    protected function _prepare()
    {
        $postFields = [
            'username' => self::sms_username,
            'password' => self::sms_password,
            'recipient' => $this->_recipients,
            'sender' => $this->_senderId,
            'message' => $this->_message,
        ];
        if (!is_null($this->_schedule)) {
            $postFields['schedule'] = $this->_schedule;
        }

        return $postFields;
    }


    /**
     * Send the sms with needed parameters set.
     *
     * @return array
     */
    public function send()
    {

        $api_url = self::api;
        $post = $this->_prepare();

        //if any parameter is missing
        //return error and give an error code
        if ( !$post['recipient'] && !$post['sender'] && !$post['message'] )
        {
            $eCode = 9999;
        }
        else
        {
            $result = self::sendRequest($api_url, $post);
            //decode the response
            $response = explode(" ", $result);

            //check if used credit was sent by API response set it
            if ( is_array($response) && !empty($response[1]) ) {
                $this->_usedCredit = $response[1];
            }
            //if u are stuck here, all went well
            //if OK is received return true and set success
            if ( trim( strtoupper($response[0]) ) == "OK" )
            {
                $this->_success = true;
                // ['succeed'=>true,'credit_used'=>$this->_usedCredit]
                return [
                    'succeed'=>true,
                    'credit_used'=>$this->_usedCredit,
                    'error_code'=>null,
                    'error_msg'=>null,
                    'response'=>'message sent successfully'
                ];
            }
            else
            {
                $eCode = trim($response[0]);
            }
        }

        //if u get here then there is error.
        $this->_getErrorFromCode($eCode);
        //return an array ['succeed'=>false,'error_code'=>$this->$_eCode,'error_msg'=>$this->_errorMSG]

        return [
            'succeed'=>false,
            'credit_used'=>0,
            'error_code'=>$this->_eCode,
            'error_msg'=>$this->_errorMSG,
            'response'=>'message not sent'
        ];
    }


    /** Get Status of request if true or false
     * @return Boolean
     */
    public function success()
    {
        return $this->_success;
    }

    /** return used credit for the request.
     * @return mixed
     */
    public function getUsedCredit()
    {
        return $this->_usedCredit;
    }

    /**Get error message in text if error was returned
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->_errorMSG;
    }

    /** Build error code & message from API error response
     * @param $eCode
     */
    private function _getErrorFromCode($eCode)
    {
        switch ($eCode)
        {
            case 2904:
                $this->_error = 1;
                $this->_errorMSG = "Sms sending failed";
                $this->_eCode = $eCode;
                break;

            case 2905:
                $this->_error = 2;
                $this->_errorMSG = "Invalid username/password";
                $this->_eCode = $eCode;
                break;

            case 2906:
                $this->_error = 3;
                $this->_errorMSG = "Credit exhausted";
                $this->_eCode = $eCode;
                break;

            case 2907:
                $this->_error = 4;
                $this->_errorMSG = "Gateway unavailable";
                $this->_eCode = $eCode;
                break;

            case 2908:
                $this->_error = 5;
                $this->_errorMSG = "Invalid date format";
                $this->_eCode = $eCode;
                break;
            case 2909:
                $this->_error = 6;
                $this->_errorMSG = "Unable to schedule date format";
                $this->_eCode = $eCode;
                break;

            case 2910:
                $this->_error = 7;
                $this->_errorMSG = "Username is empty";
                $this->_eCode = $eCode;
                break;

            case 2911:
                $this->_error = 8;
                $this->_errorMSG = "Password is empty";
                $this->_eCode = $eCode;
                break;

            case 2912:
                $this->_error = 9;
                $this->_errorMSG = "Recipient field is empty";
                $this->_eCode = $eCode;
                break;

            case 2913:
                $this->_error = 10;
                $this->_errorMSG = "Message field is empty";
                $this->_eCode = $eCode;
                break;

            case 2914:
                $this->_error = 11;
                $this->_errorMSG = "Sender field is empty";
                $this->_eCode = $eCode;
                break;

            case 2915:
                $this->_error = 12;
                $this->_errorMSG = "Required fields are empty";
                $this->_eCode = $eCode;
                break;

            case 2916:
                $this->_error = 13;
                $this->_errorMSG = "Sms sending failed (use of restricted keywords)";
                $this->_eCode = $eCode;
                break;

            case 9999:
                $this->_error = 14;
                $this->_errorMSG = "Check Sender ID, Recipients or Message";
                $this->_eCode = $eCode;
                break;

            default:
                $this->_error = 15;
                $this->_errorMSG = "Unknown error. Not fro API";
                $this->_eCode = 4444;
                break;
        }
    }

    public function getRecipients()
    {
        return $this->_recipients;
    }

    public static function get_Recipients()
    {
        return self::getRecipients();
    }

    /**
     * check sms balance.
     * @return int
     */
    public static function checkBalance()
    {
        $api_uri = self::api;
        $fields = ['username' => self::sms_username,'password' => self::sms_password,'balance' => true];
        $balance = self::sendRequest($api_uri,$fields);

        return intval($balance);
    }
    /** Send a form as HTTP request
     * @param $uri
     * @param $fields
     * @param null $method
     * @return mixed
     */
    private function sendRequest($uri, $fields, $method=null)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
} 