<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => env('MANDRIL_SECRET'),
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],

    'facebook' => [
        'client_id'     => '924192280986187',
        'client_secret' => '2906cbdbe5c384466776ff675684eef3',
        'redirect'      => env('FACEBOOK_REDIRECT'),
    ],

    'google' => [
        'client_id'     => '279874629350-pbml991ecui8m4j923sno19tia4rlrn2.apps.googleusercontent.com',
        'client_secret' => 'Ajnd_t9TMZSoz-v-CFOxTVgn',
        'redirect'      => env('GOOGLE_REDIRECT'),
    ],

    'paypal' => [
        'client_id'     => 'AaJv8UrvcrrhD-UNsUdD76xbKDqcZzkYp_OTKPDpff54-_ymlEpggyl6WektvPJoTpZi78mX1DqsAw3F',
        'client_secret' => 'EMWqs3A3msShREuw2mZ11Qa1z4xhFTuTTjcJtkJHxK_7MJnBxhLlpTWIe4U__bYDcnQkByM6EBULsQIs',
        'redirect'      => '',
    ],

    'openexchange' => [
        'app_id'        => 'ac806cdc83484890b0a9bbcd4327796c',
        'base_url'      => 'https://openexchangerates.org/api/',
    ],

];
