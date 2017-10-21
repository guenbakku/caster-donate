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
            'pdf'   => ['application/pdf'],
        ],
        'uploadFileSize' => '5M',
        'minImageSize' => [400, 400],
    ],
];