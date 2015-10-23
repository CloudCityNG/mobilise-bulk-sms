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


use App\Lib\Payments\PayPal\CheckOut;
use App\Lib\Services\Text\String;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Money\Money;


Route::get('/', function () {
    return view('test.index');
});

Route::group(
    ['prefix' => 'Payments'], function() {
        Route::get('PayPal', 'PaymentsController@processResponse');
    }
);


Route::group(
    ['prefix' => 'admin'], function() {

        Route::get('set-pricing', 'PricingController@pricing');
        Route::post('set-pricing', 'PricingController@postPricing');
    }
);


Route::get('Oauth/Authenticate/{provider?}', 'SessionsController@socialLogin');
//Route::get('Oauth/Callback', 'SessionsController@handleProviderCallback');


Route::group(
    ['prefix' => 'user'], function () {

        Route::post('credit-purchase',      'PurchaseController@postCreditPurchase');
        Route::get('credit-purchase',       'PurchaseController@creditPurchase');
        Route::get('credit-purchase/start', 'PurchaseController@start');


        Route::get('register',  'RegisterController@create');
        Route::post('register', 'RegisterController@store');



        Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
        Route::post('login', 'SessionsController@store');


        Route::get('logout', 'SessionsController@destroy');

        Route::get('dashboard',         'UserController@dashboard');
        Route::get('change-password',   'UserController@changePassword');
        Route::post('change-password',  'UserController@postChangePassword');
        Route::get('account-setting',   'UserController@accountSetting');
        Route::get('profile',           'UserController@profile');
        Route::get('security',          'UserController@security');
        Route::get('notifications',     'UserController@notifications');

        Route::get('profile-get',       'UserController@profileGet');
        Route::get('profile-edit',      'UserController@profileEdit');

    }
);

Route::group(['prefix'=>'settings'], function(){

    Route::get('profile',       'SettingsController@profile');
    Route::post('profile',      'SettingsController@postProfile');

    Route::get('security',      'SettingsController@security');
    Route::get('notifications', 'SettingsController@notifications');
});


Route::group(
    ['prefix' => 'messaging'], function () {

        Route::get('quick-sms',             ['as' => 'quick_sms', 'uses' => 'MessagingController@quickSms']);
        Route::post('quick-sms',            'MessagingController@postQuickSms');
        Route::post('quick-sms/draftSend',  'MessagingController@postQuickModalSms');

        Route::get('bulk-sms',              ['as'=>'bulk_sms', 'uses'=>'MessagingController@bulkSms']);
        Route::post('bulk-sms/fileupload',  'MessagingController@postFileUpload');
        Route::post('bulk-sms',             'MessagingController@postBulkSms');

        Route::get('file2sms',              'MessagingController@file2sms');
        Route::post('file2sms',             'MessagingController@postFile2sms');
        Route::post('file2sms/fileupload',  'MessagingController@postFileUpload2');

        Route::get('sent-sms',              'MessagingController@sentSms');
        Route::get('sent-sms/{id?}/del',    'MessagingController@delSentSms');
        Route::get('sent-sms/{id}',         'MessagingController@sentSmsId');
        Route::get('sent-sms/{id}/dlr',     'MessagingController@getDlr');
        Route::get('sent-sms/{id}/get',     'MessagingController@getSentSms');


        /**
         * Both are the same
         */
        Route::get('saved-sms',             'MessagingController@savedSms');           //View a Saved SMS
        Route::get('draft-sms',             'MessagingController@savedSms');           //View a Draft SMS
        Route::post('draft-sms',            'MessagingController@postDraftSms');       //Save a draft SMS
        Route::get('draft-sms/{id}/del',    'MessagingController@delDraftSMS');        //delete a draft SMS (ajax)
        Route::get('draft-sms/{id}/get',    'MessagingController@getDraftSMS');        //get draft SMS details (ajax)

    }
);

//Route::get('dlr-collector', 'DlrController@collector');
Route::post('dlr-collector', 'DlrController@collector');

Route::get('address-book',                              'AddressBookController@start');
Route::get('address-book/groups',                       'AddressBookController@groups');
//Route::get('address-book/new-contact', 'AddressBookController@newContact');
Route::get('address-book/new-contact',                  'AddressBookController@getNewContact');                  //
Route::get('address-book/new-group',                    'AddressBookController@getNewGroup');                      //
Route::get('address-book/contact/{id}/del',             'AddressBookController@delContact');                //
Route::get('address-book/contact/{id}/get',             'AddressBookController@getContact');                //
Route::get('address-book/contact/{id}/edit',            'AddressBookController@postContactEdit');                //
Route::get('address-book/group/{id}/del',               'AddressBookController@delGroup');                    //
Route::get('address-book/group/{id}/view-contacts',     'AddressBookController@viewContacts');      //
Route::get('address-book/group/{group_id}/new-contact', 'AddressBookController@_newContact');          //



//ajax calls
Route::get('address-book/ajax/contacts', 'AjaxController@returnContactsRaw');

//Route::get('address-book', 'AddressBookController@index');
//Route::post('address-book/new', 'AjaxController@newContact');
//Route::get('address-book/new-group', 'AjaxController@newGroup');
//Route::get('address-book/get-group', 'AjaxController@getGroup');


//Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
//Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
//Route::get('front', ['as' => 'front', 'uses' => 'HomeController@front']);



Route::resource('faq', 'faqController');
Route::get('faq/{faq}/hide', ['uses' => 'FaqController@hide']);
Route::get('faq/{faq}/show', ['uses' => 'FaqController@show_']);



Route::get('/q', 'WelcomeController@index');



//Route::get('home', ['as'=>'home', 'uses' => 'HomeController@index']);


//
//Route::get('register', ['as' => 'register_path', 'uses' => 'RegisterController@create']);
//Route::post('register', ['as' => 'register_path', 'uses' => 'RegisterController@store']);
//
//Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
//Route::post('login', ['as' => 'login_path', 'uses' => 'SessionsController@store']);
//Route::get('logout', ['as' => 'logout_path', 'uses' => 'SessionsController@destroy']);
//
//Route::get('sms/new', ['as' => 'new_sms_path', 'uses' => 'SmsController@create']);
//Route::post('sms/new', ['as' => 'new_sms_path', 'uses' => 'SmsController@store',]);
//Route::get('sms/sent', ['as' => 'sentsms_path', 'uses' => 'SmsController@show']);
//Route::get('sms/resend', ['as' => 'resendsms_path', 'uses' => 'SmsController@edit']);
//Route::get('sms/delete/{id}', ['as' => 'deletesms_path', 'uses' => 'SmsController@destroy']);
//
//Route::get('sms/draft/create', ['as' => 'draftsms_path', 'uses' => 'SmsController@draft_create']);
//Route::get('sms/draft', ['as' => 'alldraft_path', 'uses' => 'SmsController@draft_index']);
//Route::post('sms/draft', ['as' => 'postdraft_path', 'uses' => 'SmsController@postDraft']);
//
//
//Route::get('sms/sent/{id}', 'SmsController@show');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::get('test2', function(\Illuminate\Http\Request $request, CheckOut $checkOut, \App\Repository\UserDetailRepository $repository){

    return $repository->save(['firstname'=>'dbhbhsss']);
    return;

    dd(Auth::user()->userdetails->first());

    return get_gravatar('shegun.babs@gmail.com');

    $payment_info = [
//        'intent'        => 'sale',
//        'returnUrl'     => 'http://lara.app/Payments/PayPal/?success=true',
//        'cancelUrl'     => 'http://lara.app/Payments/PayPal/?success=false',
//        'description'   => 'sale of bulk sms',
        'invoiceNumber' => '72215',
//        'currency'      => 'USD',
//        'paymentMethod' => 'paypal',
        'product'       => '5000 units of bulk SMS',
        'quantity'      => 1,
        'shipping'      => 2.00,
        'price'         => 20,
    ];
    $payment_info['total'] = (float)$payment_info['price'] + (float)$payment_info['shipping'];

    $payment_info = create_object($payment_info);

    return $checkOut->process($payment_info);

    return;


    return String::randomString();

    $price = 200;
    $money = Money::NGN($price * 100);
    echo $money->getAmount();
    return;


    function randStrGen($len){
        $result = "";
        $chars = 'abcdefghijklmnopqrstuvwxyz$_?!-0123456789';
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        return $result;
    }

// Usage example
    $randstr = randStrGen(20);
    echo $randstr;
});
//Route::get('frontend', function(){
//    dd(Auth::user()->groups()->with('contacts')->get());
//});

Route::get('test', function(\Illuminate\Http\Request $request, \App\Lib\Filesystem\CsvReader $reader){

    $out = $reader->csv_to_array( storage_path('uploads/bulk-sms/file2sms.csv') );
    dd($out);
    return;

    $c = Auth::user()->contacts()->find(56);
    $c->groups()->attach(5);






//    $request = \Illuminate\Http\Request::create('/', 'POST', ['sender'=>'08099450169','recipients'=>'08033554898','message'=>'Schedule test','schedule'=>'2015-08-03 12:00:00']);
//    dd(
//        (new \App\Lib\Sms\SmsInfobip())
//            ->setSender($request->get('sender'))
//            ->setRecipients($request->get('recipients'))
//            ->setMessage($request->get('message'))
//            ->setSchedule($request->get('schedule'))
//    );

});
