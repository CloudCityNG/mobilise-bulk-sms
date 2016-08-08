<?php

use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Lib\Services\Text\CharacterCounter;
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
Route::get('/dashboard', ['as'=>'dashboard','uses'=>'UserController@dashboard2']);

//Social Login
Route::get('Oauth/Authenticate/{provider?}', 'SessionsController@socialLogin');

//Register shortcut
Route::get('/register', 'RegisterController@create');

Route::group(
    ['prefix'=>'a'], function(){
    Route::post('contacts-upload', 'AjaxController@contactsUpload');
    Route::post('contacts-file-upload', 'AjaxController@contactsFileUpload');
    Route::post('send-sms-preview', 'AjaxController@jobInfo');

});

Route::group(
    ['prefix' => 'messaging'], function () {
    Route::get('send-sms', ['as'=>'send_sms','uses' => 'MessagingController@sendSms']);
    Route::post('send-sms', ['as'=>'post_send_sms','uses'=>'MessagingController@postSendSms']);

    Route::get('file-to-sms', ['as'=>'file_to_sms','uses'=>'MessagingController@fileToSms']);
    Route::post('file-to-sms', ['as'=>'post_file_to_sms','uses'=>'MessagingController@postFileToSms']);


});

Route::group(
    ['prefix' => 'history'], function () {
    Route::get('sent-sms', ['as'=>'sent_sms_list','uses' => 'MessagingController@sentSms']);
    Route::get('sent-sms/{id}', ['as'=>'sent_sms','uses' => 'MessagingController@sentSmsId']);
    Route::get('sent-sms/{id}/get-dlr', 'MessagingController@sentSmsIdDlr');
    Route::get('sent-sms/{id}/get-dlr/view', 'MessagingController@sentSmsIdDlrView');

    Route::get('draft-sms', ['as'=>'draft_sms_list','uses'=>'MessagingController@savedSms']);
    Route::get('draft-sms/{id}', ['as'=>'draft_sms','uses'=>'MessagingController@getDraftSMS']);
    Route::post('draft-sms', ['as'=>'post_draft_sms','uses'=>'MessagingController@postDraftSms']);
    Route::get('draft-sms/{id}/del', ['as'=>'del_draft_sms','uses'=>'MessagingController@delDraftSMS']);
});



//All user links
Route::group(
    ['prefix' => 'user'], function () {

    Route::get('profile', ['as'=>'profile_path','uses'=>'UserController@profile']);
    Route::get('profile-edit', ['as'=>'profile_edit_path','uses'=>'UserController@profileEdit']);
    Route::post('profile-edit', ['as'=>'profile_edit_path','uses'=>'UserController@postProfileEdit']);
    Route::get('support', ['as'=>'support_path','uses'=>'UserController@support']);
    Route::get('faqs', ['as'=>'faqs_path','uses'=>'UserController@faqs']);
    Route::get('settings', ['as'=>'settings_path','uses'=>'UserController@settings']);
    //user who is not an admin is redirected here
    //Route::get('not-admin');
    Route::get('register', 'RegisterController@create');
    Route::post('register', 'RegisterController@store');

    Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
    Route::post('login', 'SessionsController@store');
    Route::get('logout', ['as'=>'logout_path','uses'=>'SessionsController@destroy']);


    Route::get('credit-purchase/start', 'PurchaseController@start');
    Route::post('credit-purchase', ['as'=>'purchase_path','PurchaseController@postCreditPurchase']);
    Route::get('credit-purchase', 'PurchaseController@creditPurchase');
    Route::get('credit-purchase/approve/{order_id}/txid/{txid}/poid/{poid}/quantity/{quantity}/unitprice/{unit_price}/price/{price}/item/{item}', 'PurchaseController@approve');


    Route::get('payment-return', 'PurchaseController@paymentReturn');

    Route::get('dashboard', 'UserController@dashboard');
    Route::get('change-password', 'UserController@changePassword');
    Route::post('change-password', 'UserController@postChangePassword');
    Route::get('account-setting', 'UserController@accountSetting');

    Route::get('security', 'UserController@security');
    Route::get('notifications', 'UserController@notifications');

    Route::get('profile-get', 'UserController@profileGet');
    Route::get('profile-edit', 'UserController@profileEdit');

});

Route::group(['prefix' => 'billing'], function () {
    Route::get('orders', ['as'=>'orders_path','uses'=>'BillingController@orders']);
    Route::get('payments', ['as'=>'payments_path','uses'=>'BillingController@payments']);
});


//API Routes
Route::group(
    ['prefix' => 'api/v1/sms', 'middleware' => 'auth.api'], function () {

    Route::post('single', 'ApiController@single');
});

Route::get('client-registration', function(){
    $client_managers = [
        'adekunle@gmail.com' => 'Adekunle Jimoh',
        '' => 'Seun Ogundele',
        '' => 'Esther Ekegbo',
        '' => 'Alice Edet',
        '' => 'Elizabeth Ogbu',
    ];
    return view('layouts.landing.client-registration');
});
//API testing routes
Route::get('api-test', function (PhoneUtil $phoneUtil, \App\Lib\Filesystem\CsvReader $reader) {

    dd(session('uploadedNumbersFromFile'));
    return \App\Lib\Filesystem\CsvReader::readCsvNewLine(storage_path('uploads/blacklist.txt'));


});