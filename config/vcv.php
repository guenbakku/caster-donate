<?php

/**
 * Validate control values
 */
return [
    'AllowFileTypes' => [
        'image' => ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'],
        'pdf'   => ['application/pdf'],
    ],
    'uploadFileSize' => '5MB',
];