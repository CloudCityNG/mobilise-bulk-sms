<?php
namespace App\Http\Forms;


use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Lib\Services\Text\CharacterCounter;
use Illuminate\Http\Request;

class QuicSmsForm extends Form
{

    protected $rules = [
        'sender' => 'required|min:3|max:11',
        'recipients' => 'required',
        'message' => 'required|min:1|max:480',
        'schedule' => 'boolean',
        'date' => 'date|after:yesterday|required_with:schedule',
        'time' => 'required_with:date',
        'timezone' => 'required_with:time',
        'flash' => 'boolean',
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

            if ( $this->schedule == 1 )
                $this->request->merge(['schedule' => "$this->date $this->time $this->timezone"]);
            //add user_id to request
            $this->request->merge(['user_id' => $this->request->user()->id]);
            //$this->request->session()->put('send-sms-fields', $this->fields());
            //return $this->persist();
            return true;
        }
        return false;
    }


    public function persist()
    {
        return $this->prepare();
    }


    private function prepare_http()
    {
        $sms_pages = CharacterCounter::countPage($this->message)->pages;
        $numbers = array_unique($this->explodeRecipients($this->recipients));
        $out = [];

        if (count($numbers) > 0):
            foreach ($numbers as $number) {
                $this->phoneUtil->number($number);
                if ($this->phoneUtil->isValid()):
                    $region_network[] = ['region|network' => $this->phoneUtil->getRegion() . '|' . $this->phoneUtil->carrier(),];
                else:
                    $region_network[] = ['region|network' => 'invalid|invalid',];
                endif;
            }
            $response = collect($region_network)->groupBy('region|network')->toArray();

            foreach ($response as $key => $value):
                $cast = explode("|", $key);
                $count = count($value);
                $out[] = [
                    'country' => $cast[0],
                    'network' => $cast[1],
                    'total_recipients' => $count,
                    'unit_per_sms' => $this->phoneUtil->getChargeByDialingCode(),
                ];
            endforeach;
            return ['out' => $out, 'others' => ['sms_count' => $sms_pages]];
        endif;
    }


    public function prepare()
    {
        if ($this->request->ajax()):

            $sms_pages = CharacterCounter::countPage($this->message)->pages;
            $numbers = array_unique($this->explodeRecipients($this->recipients));
            $out = [];

            if (count($numbers) > 0):
                foreach ($numbers as $number) {
                    $this->phoneUtil->number($number);
                    if ($this->phoneUtil->isValid()):
                        $region_network[] = ['region|network' => $this->phoneUtil->getRegion() . '|' . $this->phoneUtil->carrier(),];
                    else:
                        $region_network[] = ['region|network' => 'invalid|invalid',];
                    endif;
                }
                $response = collect($region_network)->groupBy('region|network')->toArray();

                foreach ($response as $key => $value):
                    $cast = explode("|", $key);
                    $count = count($value);
                    $out[] = [
                        'country' => $cast[0],
                        'network' => $cast[1],
                        'total_recipients' => $count,
                        'unit_per_sms' => $this->phoneUtil->getChargeByDialingCode(),
                    ];
                endforeach;
                return response()->json([
                    'success' => 'true',
                    'out' => $out,
                    'others' => [
                        'sms_count' => $sms_pages,
                    ],
                ]);
            endif;
            return response()->json(['success' => 'false']);
        else:
            return $this->prepare_http();
        endif;

    }


    protected function explodeRecipients($recipients)
    {
        //$recipients = str_replace(["\n","\n\r","\r"], ",", $recipients);
        //$recipients = preg_replace('/\s+/', ",", $recipients);
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