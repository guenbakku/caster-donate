<?php

return [
    'Users' => [
        // Table used to manage users
        'table' => 'App.Users',
        // Controller used to manage users plugin features & actions
        'controller' => 'CakeDC/Users.Users',
        // configure Auth component
        'auth' => true,
        'Email' => [
            // determines if the user should include email
            'required' => true,
            // determines if registration workflow includes email validation
            'validate' => true,
        ],
        'Registration' => [
            // determines if the register is enabled
            'active' => true,
            // determines if the reCaptcha is enabled for registration
            'reCaptcha' => true,
            //ensure user is active (confirmed email) to reset his password
            'ensureActive' => false,
            // default role name used in registration
            'defaultRole' => 'user',
        ],
        'reCaptcha' => [
            // reCaptcha key goes here
            'key' => '6Lc2vTMUAAAAAIab-uUMjRi1ObCoxWGBRqPFR_2o',
            // reCaptcha secret
            'secret' => '6Lc2vTMUAAAAAJh-g1WuXzyvpJ93saEzVrqnOwj1',
            // use reCaptcha in registration
            'registration' => true,
            // use reCaptcha in login, valid values are false, true
            'login' => false,
        ],
        'Tos' => [
            // determines if the user should include tos accepted
            'required' => true,
        ],
        'Social' => [
            // enable social login
            'login' => true,
        ],
        // Avatar placeholder
        'Avatar' => [
            'placeholder' => 'CakeDC/Users.avatar_placeholder.png'
        ],
        'RememberMe' => [
            // configure Remember Me component
            'active' => true,
        ],
    ],

    // default configuration used to auto-load the Auth Component, override to change the way Auth works
    'Auth' => [
        'loginAction' => [
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => 'login',
            'prefix' => false,
        ],
        'authenticate' => [
            'all' => [
                'finder' => 'auth',
            ],
            'CakeDC/Auth.ApiKey',
            'CakeDC/Auth.RememberMe',
            'Form',
        ],
        'authorize' => [
            'CakeDC/Auth.Superuser',
            'CakeDC/Auth.SimpleRbac',
        ],
        'loginRedirect' => [
            'plugin' => false,
            'prefix' => 'front',
            'controller' => 'Home',
            'action' => 'index',
        ],
        'logoutRedirect' => [
            'plugin' => false,
            'prefix' => 'front',
            'controller' => 'Home',
            'action' => 'index',
        ]
    ],

    'OAuth' => [
        'providers' => [
            'facebook' => [
                'options' => [
                    'clientId' => env('FACEBOOK_CLIENT_ID', '195322367903151'),
                    'clientSecret' => env('FACEBOOK_CLIENT_SECRET', 'd93a5973d5d7a75e36723b2e08a5f3c7'),
                ],
            ],
            'google' => [
                'options' => [
                    'clientId' => env('GOOGLE_CLIENT_ID', '822481616028-ksobnsmud6l4jm39nnjames0p0j7ms43.apps.googleusercontent.com'),
                    'clientSecret' => env('GOOGLE_CLIENT_SECRET', '9E0uIaoz_2_g2-TPz8Rj5Cex'),
                ],
            ]
        ],
    ],
];