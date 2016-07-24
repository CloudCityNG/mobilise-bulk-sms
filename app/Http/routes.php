<?php

//use App\Lib\Payments\PayPal\CheckOut;
use App\Lib\Payments\InterSwitch\CheckOut;
use App\Lib\Services\Text\String as Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('lte', function(){
    return view('adminlte.messaging.quicsms');
});

//All AJAX rules
Route::group(
    ['prefix'=>'a'], function(){

    Route::post('confirm-job', 'AjaxController@jobInfo');
});




Route::get('login/{id}', function ($id) {
    Auth::loginUsingId($id);
    return redirect()->to('user/dashboard');
});








Route::group(
    ['prefix' => 'Payments'], function () {
    Route::get('PayPal', 'PaymentsController@processResponse');
}
);



//Route::get('Oauth/Callback', 'SessionsController@handleProviderCallback');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {

    Route::get('set-pricing', 'PricingController@pricing');
    Route::post('set-pricing', 'PricingController@postPricing');

    Route::get('search', 'AdminController@search');
    Route::post('search', 'AdminController@postSearch');

    Route::get('user/{id}', 'UserController@start');
});






Route::group(['prefix' => 'settings'], function () {
    Route::get('account', 'SettingsController@account');
    Route::post('account', 'SettingsController@postAccount');
    Route::get('other-details', 'SettingsController@other_details');
    Route::get('notifications', 'SettingsController@notifications');
});

Route::group(['prefix' => 'app'], function () {
    Route::get('about-us', 'SupportController@about_us');
    Route::get('contact-us', 'SupportController@contact_us');
    Route::get('sitemap', 'SupportController@sitemap');
    Route::get('customer-support', 'SupportController@customer_support');
    Route::get('terms', 'SupportController@terms');
});

Route::group(['prefix' => 'setting'], function () {

    Route::get('profile', 'SettingsController@profile');
    Route::post('profile', 'SettingsController@postProfile');

    Route::get('security', 'SettingsController@security');
    Route::get('notifications', 'SettingsController@notifications');
});


Route::group(
    ['prefix' => 'messaging'], function () {

    Route::get('quic-sms', ['as' => 'quic_sms', 'uses' => 'MessagingController@quic']);
    Route::post('quic-sms', 'MessagingController@confirmQuic');

    Route::get('quick-sms', ['as' => 'quick_sms', 'uses' => 'MessagingController@quickSms']);
    Route::post('quick-sms', 'MessagingController@postQuickSms');
    Route::post('quick-sms/draftSend', 'MessagingController@postQuickModalSms');

    Route::get('bulk-sms', ['as' => 'bulk_sms', 'uses' => 'MessagingController@bulkSms']);
    Route::post('bulk-sms/fileupload', 'MessagingController@postFileUpload');
    Route::post('bulk-sms', 'MessagingController@postBulkSms');

    Route::get('file2sms', 'MessagingController@file2sms');
    Route::post('file2sms', 'MessagingController@postFile2sms');
    Route::post('file2sms/fileupload', 'MessagingController@postFileUpload2');

    Route::get('sent-sms', 'MessagingController@sentSms');
    Route::get('sent-sms/{id}', 'MessagingController@sentSmsId');
    Route::get('sent-sms/{id}/get-dlr', 'MessagingController@sentSmsIdDlr');
    Route::get('sent-sms/{id}/get-dlr/view', 'MessagingController@sentSmsIdDlrView');
    Route::get('sent-sms/{id}/del', 'MessagingController@delSentSms');
    Route::get('sent-sms/{id}/delete', 'MessagingController@deleteSentSms');
    Route::get('sent-sms/{id}/forward', 'MessagingController@sentSmsForward');
    Route::get('sent-sms/{id}/dlr', 'MessagingController@getDlr');
    Route::get('sent-sms/{id}/get', 'MessagingController@getSentSms');
    /**
     * Both are the same
     */
    Route::get('saved-sms', 'MessagingController@savedSms');           //View a Saved SMS
    Route::get('draft-sms', 'MessagingController@savedSms');           //View a Draft SMS

    Route::get('draft-sms/{id}/del', 'MessagingController@delDraftSMS');        //delete a draft SMS (ajax)
    Route::get('draft-sms/{id}/get', 'MessagingController@getDraftSMS');        //get draft SMS details (ajax)

}
);
//Route::get('dlr-collector', 'DlrController@collector');
Route::post('dlr-collector', 'DlrController@collector');

Route::group(
    ['prefix' => 'contact'], function () {

    Route::get('new-contact', 'ContactController@newContact');
}
);

Route::get('contact', 'ContactController@index');
Route::get('contact/index', 'ContactController@index');
Route::get('contact/all', 'ContactController@index');

Route::get('address-book', 'AddressBookController@start');
Route::get('address-book/groups', 'AddressBookController@groups');
//Route::get('address-book/new-contact', 'AddressBookController@newContact');
Route::get('address-book/new-contact', 'AddressBookController@getNewContact');                  //
Route::get('address-book/new-group', 'AddressBookController@getNewGroup');                      //
Route::get('address-book/contact/{id}/del', 'AddressBookController@delContact');                //
Route::get('address-book/contact/{id}/get', 'AddressBookController@getContact');                //
Route::get('address-book/contact/{id}/edit', 'AddressBookController@postContactEdit');                //
Route::get('address-book/group/{id}/del', 'AddressBookController@delGroup');                    //
Route::get('address-book/group/{id}/view-contacts', 'AddressBookController@viewContacts');      //
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


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::get('backend', function () {
    return view('pages.layouts.master');
});


Route::get('backend/quic-sms', function () {
    return view('backend.quic-sms');
});


Route::get('new', function () {
    return view('layouts.kanda.master');
});


Route::get('p', function (\Illuminate\Http\Request $request, CheckOut $checkOut, \App\Repository\UserDetailRepository $repository) {

    $payment_info = [
//        'intent'        => 'sale',
//        'returnUrl'     => 'http://lara.app/Payments/PayPal/?success=true',
//        'cancelUrl'     => 'http://lara.app/Payments/PayPal/?success=false',
//        'description'   => 'sale of bulk sms',
        'invoiceNumber' => '72215',
//        'currency'      => 'USD',
//        'paymentMethod' => 'paypal',
        'product' => '5000 units of bulk SMS',
        'quantity' => 1,
        'shipping' => 2.00,
        'price' => 20,
    ];
    $payment_info['total'] = (float)$payment_info['price'] + (float)$payment_info['shipping'];

    $payment_info = create_object($payment_info);

    return $checkOut->process($payment_info);

    return;


    return Str::randomString();

    $price = 200;
    $money = Money::NGN($price * 100);
    echo $money->getAmount();
    return;

});


Route::get('r', function (\Illuminate\Http\Request $request, \App\Lib\Filesystem\CsvReader $reader) {

    $c = Auth::user()->contacts()->find(56);
    $c->groups()->attach(5);
});
