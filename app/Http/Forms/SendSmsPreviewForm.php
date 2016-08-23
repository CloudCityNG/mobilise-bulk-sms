<?php

namespace App\Http\Forms;


use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Lib\Services\Text\CharacterCounter;
use Illuminate\Http\Request;

class SendSmsPreviewForm extends Form
{


    protected $rules = [
        'sender' => 'required|min:3|max:11',
        'recipients' => 'required',
        'message' => 'required|min:1|max:480',
        'schedule' => 'boolean',
        'datetime' => 'required_with:schedule|compare_time',
        'flash' => 'boolean',
    ];


    protected $messages = [
        'datetime.compare_time' => 'Scheduled Datetime is behind present time.',
    ];

    /**
     * @var PhoneUtil
     */
    private $phoneUtil;

    public function __construct(Request $request, PhoneUtil $phoneUtil)
    {
        parent::__construct($request);
        $this->phoneUtil = $phoneUtil;
    }


    public function save()
    {
        if ($this->isValid()) {
            return $this->prepare_preview();
        }
        return false;
    }


    public function persist()
    {
        return $this->prepare();
    }


    public function prepare_preview()
    {
        $sms_pages = CharacterCounter::countPage($this->message)->pages;
        $numbers_array = $this->explodeRecipients($this->recipients);
        $numbers_unique = array_unique($numbers_array);
        $duplicates = array_diff_assoc($numbers_array, $numbers_unique);
        $data = [];
        $invalid_numbers = [];

        foreach ($numbers_unique as $number):
            $this->phoneUtil->number($number);
            if ($this->phoneUtil->isValid()):
                $country = $this->phoneUtil->getRegion();
                $carrier = $this->phoneUtil->carrier();
                if (array_key_exists("$country|$carrier", $data)):
                    $count = (int)$data["$country|$carrier"]['total_recipients'] + 1;
                    $data["$country|$carrier"]['total_recipients'] = $count;
                else:
                    $data["$country|$carrier"] = ['total_recipients' => 1, 'price' => $this->phoneUtil->getChargeByDialingCode()];
                endif;
            else:
                $invalid_numbers[] = $number;
            endif;
        endforeach;
        return [
            'data' => $data,
            'duplicates' => $duplicates,
            'invalid' => $invalid_numbers,
            'valid' => $numbers_unique,
            'sms_pages' => $sms_pages,
        ];
    }


    protected function explodeRecipients($recipients)
    {
        $numbers = explode(",", $recipients);
        $numbers = array_filter($numbers, function ($var) {
            if ("" !== trim($var)) {
                return true;
            }
        });
        $numbers = array_map('trim', $numbers);
        return $numbers;
    }

}