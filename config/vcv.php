<?php

/**
 * Validate control values
 *
 * @package: App
 */
return [
    'vcv' => [
        'AllowFileTypes' => [
            'image' => ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'],
            'audio' => ['audio/mpeg', 'audio/ogg'],
            'pdf'   => ['application/pdf'],
        ],
        'uploadFileSize' => '5M',
    ],
];