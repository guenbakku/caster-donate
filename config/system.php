<?php

/**
 * Settings for this system
 *
 * @package: App
 */
return [
    'System' => [
        'sitename' => 'Tôi Lên Sóng',
        'version' => '0.0.1',

        /*
         * Paths point to file/directory on server
         */
        'Paths' => [
            'avatar_dir' => 'webroot'.DS.'img'.DS.'avatar'.DS,
        ],

        /*
         * Paths to generate urls
         * Below does not need to use constant 'DS' because seperator
         * in url is always '/'
         */
        'Urls' => [
            'avatar_dir' => 'avatar/',
            'default_avatar' => 'default_avatar.jpg',
        ]
    ],
];