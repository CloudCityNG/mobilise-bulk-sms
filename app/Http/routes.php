<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Commands\CreateNewUserCommand;
use App\Lib\Log\Logger;
use App\Lib\Mobilise\UrlConnector;
use App\Lib\Sms\SmsHttp;
use App\Lib\Sms\SmsInfobip;
use App\Models\Sms\SmsCredit;
use App\Models\Sms\SmsCreditUsage;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\User;
use Carbon\Carbon;
use App\Models\Sms\SentSmsHistory as sentsmshistory;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;


Route::group(
    ['prefix' => 'user'], function () {

        Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
        Route::post('login', 'SessionsController@store');
        Route::get('logout', 'SessionsController@destroy');

        Route::get('dashboard', 'HomeController@dashboard');

    }
);


Route::group(
    ['prefix' => 'messaging'], function () {

        Route::get('quick-sms', ['as' => 'quick_sms', 'uses' => 'MessagingController@quickSms']);
        Route::post('quick-sms', 'MessagingController@postQuickSms');

        Route::get('bulk-sms', 'MessagingController@bulkSms');
        Route::post('bulk-sms', 'MessagingController@postBulkSms');

        Route::get('file2sms', 'MessagingController@file2sms');
        Route::post('file2sms', 'MessagingController@postFile2sms');

        Route::get('sent-sms', 'MessagingController@sentSms');
        Route::get('sent-sms/{id}', 'MessagingController@sentSmsId');

        Route::get('saved-sms', 'MessagingController@savedSms');

        Route::post('draft-sms', 'MessagingController@postDraftSms');
    }
);


Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);



Route::resource('faq', 'faqController');
Route::get('faq/{faq}/hide', ['uses' => 'FaqController@hide']);
Route::get('faq/{faq}/show', ['uses' => 'FaqController@show_']);


Route::get('/q', 'WelcomeController@index');

//Route::get('home', ['as'=>'home', 'uses' => 'HomeController@index']);



Route::get('register', ['as' => 'register_path', 'uses' => 'RegisterController@create']);
Route::post('register', ['as' => 'register_path', 'uses' => 'RegisterController@store']);

Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
Route::post('login', ['as' => 'login_path', 'uses' => 'SessionsController@store']);
Route::get('logout', ['as' => 'logout_path', 'uses' => 'SessionsController@destroy']);

Route::get('sms/new', ['as' => 'new_sms_path', 'uses' => 'SmsController@create']);
Route::post('sms/new', ['as' => 'new_sms_path', 'uses' => 'SmsController@store',]);
Route::get('sms/sent', ['as' => 'sentsms_path', 'uses' => 'SmsController@show']);
Route::get('sms/resend', ['as' => 'resendsms_path', 'uses' => 'SmsController@edit']);
Route::get('sms/delete/{id}', ['as' => 'deletesms_path', 'uses' => 'SmsController@destroy']);

Route::get('sms/draft/create', ['as' => 'draftsms_path', 'uses' => 'SmsController@draft_create']);
Route::get('sms/draft', ['as' => 'alldraft_path', 'uses' => 'SmsController@draft_index']);
Route::post('sms/draft', ['as' => 'postdraft_path', 'uses' => 'SmsController@postDraft']);


Route::get('sms/sent/{id}', 'SmsController@show');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('test2', function () {

    echo \App\Lib\Services\Text\CharacterCounter::countPage('jakie jambad
    ssssqqwqw')->pages;

    //dd (Auth::user()->smsCredit()->available_credit);

    return;

    //process response
    $result = '{"results": [ {"status":"0","messageid":"185060816184839591","destination":"2348188697770"}, {"status":"0","messageid":"155060816184838810","destination":"2348099450165"} ]}';
    $response = json_decode($result, true);

    $recipients = [];

    foreach ($response['results'] as $result) :
        $recipients[] = SmsHistoryRecipient::store($result['status'], $result['messageid'], $result['destination']);
    endforeach;

    $s = SmsHistory::find($d->id);
    $s->smsHistoryRecipients()->saveMany($recipients);


    return;


});

Route::get('test', function () {
    $urls = [
        'phone_backup' => 'http://support.easyphonebackup.com',
        'sms_backup' => 'http://support.easysmsbackup.com',
        'malert' => 'http://support.mobicontent.mobiliseafrica.com',
        'mhealth' => 'http://support.eazeehealth.com',
        'mbusiness' => 'http://support.mobibizness.mobiliseafrica.com',
        'mlearning' => 'http://support.mobimlearn.mobiliseafrica.com',
    ];

    //check url
    $c = new UrlConnector();
    $logger_filename = storage_path('logs/mobilise-' . date('Y-m-d') . '.log');
    $l = new Logger($logger_filename);

    foreach ($urls as $url_name => $url_address) {
        $c->get($url_address);
        $s = $c->get_return_info();
        $log_string = "url --->" . $s['url'] . "\t" . "http_code --->" . $s['http_code'] . "\t" . "IP --->" . $s['primary_ip'];

        //log
        $l->AddRow($log_string);
    }
    $l->Commit();
});

//Route::get('/test', function() {
//
//
//    dd( (new \App\Repository\SmsDraftRepository())->paginate(5) );
////    return SmsCreditUsage::create([
////        'user_id'=>2,
////        'sms_history_id'=>8,
////        'used_units' => 5,
////        'comment' => 'sms debit'
////    ]);
////    dd( Auth::user()->sentsms()->with('user')->latest()->paginate(3) );
////    $sms = new SmsHttp();
////    $sms = $sms->setSender('segun')
////        ->setRecipients('08188697770,08099450165')
////        ->setMessage('here is my message')
////        //->scheduleMessage(Carbon::now()->addSeconds(20)->timestamp)
////        ->send();
////    dd($sms);
//
//});