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
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe'   => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],
    'facebook' => [
        'client_id'     => getenv('FB_CLIENT_ID'),
        'client_secret' => getenv('FB_CLIENT_SECRET'),
//        'redirect'      => 'https://pakblood.com/fbAuth',
        'redirect'      => 'http://localhost:8000/fbAuth',
    ],
    'google'   => [
        'client_id'     => getenv('GOOGLE_CLIENT_ID'),
        'client_secret' => getenv('GOOGLE_CLIENT_SECRET'),
//        'redirect'      => 'https://pakblood.com/gpAuth',
        'redirect'      => 'http://localhost:8000/gpAuth',
    ],

];
