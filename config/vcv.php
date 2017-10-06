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
        'uploadFileSize' => '5MB',
        'minImageSize' => [400, 400],
    ],
];