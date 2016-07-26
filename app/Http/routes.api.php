<?php

use Carbon\Carbon;
//cleaning useful routes here

//Homepage
Route::get('/', function () {
    return redirect()->to('user/login');
    return view('layouts.landing.landing');
    return view('layouts.frontend');
});

// Home & Dashboard shortcut/alias
Route::get('/home', 'UserController@dashboard');
Route::get('/dashboard', 'UserController@dashboard');

//Social Login
Route::get('Oauth/Authenticate/{provider?}', 'SessionsController@socialLogin');

//Register shortcut
Route::get('/register', 'RegisterController@create');


Route::group(
    ['prefix' => 'messaging'], function () {
    Route::get('send-sms', ['as'=>'send_sms','uses' => 'MessagingController@sendSms']);
    Route::post('send-sms', 'MessagingController@postSendSms');
    //save draft SMS
    Route::post('draft-sms', 'MessagingController@postDraftSms');
});




//All user links
Route::group(
    ['prefix' => 'user'], function () {

    //user who is not an admin is redirected here
    //Route::get('not-admin');
    Route::get('register', 'RegisterController@create');
    Route::post('register', 'RegisterController@store');

    Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
    Route::post('login', 'SessionsController@store');
    Route::get('logout', 'SessionsController@destroy');


    Route::get('credit-purchase/start', 'PurchaseController@start');
    Route::post('credit-purchase', 'PurchaseController@postCreditPurchase');
    Route::get('credit-purchase', 'PurchaseController@creditPurchase');
    Route::get('credit-purchase/approve/{order_id}/txid/{txid}/poid/{poid}/quantity/{quantity}/unitprice/{unit_price}/price/{price}/item/{item}', 'PurchaseController@approve');


    Route::get('payment-return', 'PurchaseController@paymentReturn');

    Route::get('dashboard', 'UserController@dashboard');
    Route::get('change-password', 'UserController@changePassword');
    Route::post('change-password', 'UserController@postChangePassword');
    Route::get('account-setting', 'UserController@accountSetting');
    Route::get('profile', 'UserController@profile');
    Route::get('security', 'UserController@security');
    Route::get('notifications', 'UserController@notifications');

    Route::get('profile-get', 'UserController@profileGet');
    Route::get('profile-edit', 'UserController@profileEdit');

});

Route::group(['prefix' => 'billing'], function () {
    Route::get('orders', 'BillingController@orders');
    Route::get('payments', 'BillingController@payments');
});


//API Routes
Route::group(
    ['prefix' => 'api/v1/sms', 'middleware' => 'auth.api'], function () {

    Route::post('single', 'ApiController@single');
});

//API testing routes
Route::get('api-test', function (\App\Lib\Sms\PenSmsApi $api, \App\Lib\Sms\SmsPen $pen) {



    return;

    $result = $api->setSender('Mobiliseafr')
        ->setRecipients('08099450165')
        ->setMessage('Message is via pensms')
        ->send()
        ;
    //dd($result);
    echo $result;

});