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
		'secret' => 'v63YmfvbJJl6sbYtbkT6Bg',
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
        'redirect'      => 'http://lara.app/Oauth/Authenticate'
    ],

    'google' => [

    ],

];
