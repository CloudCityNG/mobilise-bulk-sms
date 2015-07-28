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

use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('test.index');
});

Route::group(
    ['prefix' => 'user'], function () {

        Route::get('register', 'RegisterController@create');
        Route::post('register', 'RegisterController@store');
        Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
        Route::post('login', 'SessionsController@store');
        Route::get('logout', 'SessionsController@destroy');

        Route::get('dashboard', 'UserController@dashboard');
        Route::get('change-password', 'UserController@changePassword');
        Route::post('change-password', 'UserController@postChangePassword');
        Route::get('account-setting', 'UserController@accountSetting');

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


Route::get('address-book', 'AddressBookController@start');
Route::get('address-book/groups', 'AddressBookController@groups');
//Route::get('address-book/new-contact', 'AddressBookController@newContact');
Route::get('address-book/new-contact', 'AddressBookController@getNewContact');
Route::get('address-book/new-group', 'AddressBookController@getNewGroup');

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

//Route::get('frontend', function(){
//    dd(Auth::user()->groups()->with('contacts')->get());
//});

Route::get('test/email', function(){
    return view('auth.reset2',['token'=>'TestUser']);
});
