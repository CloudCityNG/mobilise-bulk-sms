<?php

namespace App\Http\Controllers;

use App\Http\Forms\SingleSmsApiForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    protected $rules = [
        'auth' => 'required|auth',
        'from' => ['required', 'alpha_dash', 'alpha_num', 'min:3', 'not_in:mtn,glo'],
        'text' => 'required',
        'flash' => 'boolean',
        'schedule' => 'compare_time',
//        'to' => 'required',
        'to.*.gsm' => 'required',
    ];


    protected $messages = [
        'auth.required' => '-15:EMPTY_CREDENTIALS',
        'auth.auth' => '-14:INVALID_CREDENTIALS',
        'from.required' => '-16:EMPTY_SENDER',
        'from.min' => '-17:SENDER_TOO_SHORT',
        'text.required' => '-18:EMPTY_TEXT',
        'flash.boolean' => '-19:INVALID_FLASH_OPTION',
        'schedule.compare_time' => '-20:INVALID_SCHEDULE_DATETIME',
        'to.required' => '-22:EMPTY_DESTINATION_ADDRESS',
        'to.*.gsm.required' => "-22:DESTINATION_ADDRESS_EMPTY",
    ];


    public function single(Request $request)
    {
        //dd($request->to);
        $response = ['response' => [],];

        if (empty($request->all())):
            return response()->json([
                'response' => [
                    'status' => -22,
                    'description' => 'SYNTAX_ERROR',
                ],
            ]);
        endif;

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()):

            $messages = $validator->errors();
            dd($messages);

            switch ($messages->count()) {
                case($messages->has('auth')):
                    $res = $this->splitString($messages->messages()['auth'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has('from')):
                    $res = $this->splitString($messages->messages()['from'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has('text')):
                    $res = $this->splitString($messages->messages()['text'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has('flash')):
                    $res = $this->splitString($messages->messages()['flash'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has('schedule')):
                    $res = $this->splitString($messages->messages()['schedule'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has('type')):
                    $res = $this->splitString($messages->messages()['type'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has('to')):
                    $res = $this->splitString($messages->messages()['to'][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;
                case($messages->has("to.*.gsm")):
                    $res = $this->splitString($messages->messages()["to.*.gsm"][0]);
                    $response['response'][] = [
                        'status' => $res['status'],
                        'description' => $res['description'],
                    ];
                    break;

            }


            return response()->json($response);
        endif;

        return response()->json(['success' => true]);
    }

    private function splitString($string)
    {
        $split = explode(":", $string);

        return [
            'status' => $split[0],
            'description' => $split[1],
        ];
    }
}
