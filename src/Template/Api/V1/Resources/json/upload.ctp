<?php
use Cake\Utility\Hash;

if (!$resource->errors()) {   
    $result = [
        'title' => __('Hoàn tất'),                    
        'message' => __('File đã được tải lên.'),
        'data' => array_merge($resource->toArray(), [
            'url' => $resource->url,
        ]),
    ];
} else {
    $result = [
        'title' => __('Lỗi'),
        'errors' => array_values(Hash::flatten($resource->errors())),
    ];
}

echo $this->ApiResponseHandler->setResult($result);
?>