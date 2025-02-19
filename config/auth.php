<?php

return [

    
        /*
        |--------------------------------------------------------------------------
        | Authentication Defaults
        |--------------------------------------------------------------------------
        |
        | This option defines the default authentication "guard" and password
        | reset "broker" for your application. You may change these values
        | as required, but they're a perfect start for most applications.
        |
        */
    
        'defaults' => [
            'guard' => 'api',
            'passwords' => 'users',
        ],
    
      
       /*
        |--------------------------------------------------------------------------
        | Authentication Guards
        |--------------------------------------------------------------------------
        |
        | Next, you may define every authentication guard for your application.
    
        | Of course, a great default configuration has been defined for you
        | which utilizes session storage plus the Eloquent user provider.
        |
        | All authentication guards have a user provider, which defines how the
        | users are actually retrieved out of your database or other storage
        | system used by the application. Typically, Eloquent is utilized.
        |
        | Supported: "session"
        |
        */
    
        'guards' => [
            'web' => [
                'driver' => 'session',
                'provider' => 'users',
            ],
            'api' => [
                'driver' => 'jwt',
                'provider' => 'users',
            ],
        ],
    
    
    
];
