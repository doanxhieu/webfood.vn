<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    // 'facebook' => [
    //     'client_id' => env('FACEBOOK_CLIENT_ID'),         // Your GitHub Client ID
    //     'client_secret' => env('FACEBOOK_CLIENT_SECRET'), // Your GitHub Client Secret
    //     'redirect' => env('FACEBOOK_CALLBACK_URL'),
    // ],
    'facebook' => [
        'client_id' => '158043501575131',         // Your GitHub Client ID
        'client_secret' => 'db9216851dc92548392ce6910331a2e2', // Your GitHub Client Secret
        'redirect' => 'http://localhost:8000/admin/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '462449422940-6r2n3i1d4628h06tivo2fm84ia4tak5a.apps.googleusercontent.com',         // Your GitHub Client ID
        'client_secret' => 'xL7H0lzwr7VrysKah3r-dFiS', // Your GitHub Client Secret
        'redirect' => 'http://localhost:8000/admin/login/google/callback',
    ],
];
