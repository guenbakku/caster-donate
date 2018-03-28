<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\Network\Exception\BadRequestException;
use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Resources;

class ResourcesController extends ApiController
{
    public function upload()
    {
        $user_id = $this->Auth->user('id');
        $Resources = new Resources();

        $result=[
            'result'    => false,
            'title'    => __('Lỗi'),
            'message'   => false,
            'resource'  =>   [],
            'url'   => '',
        ];

        if ($this->request->is('post')) {
            $new_resource = $this->request->getData();
            $resource = $Resources->addPrivateResource($user_id, $new_resource);

            if (!$resource->errors()) {   
                $result=[
                    'result'    => true,
                    'title'    => __('Hoàn tất'),                    
                    'message'   => __('File đã được tải lên.'),
                    'resource' => array_merge($resource->toArray(), [
                        'url' => $resource->url,
                    ])
                ];
            } else {
                $errors = Hash::flatten($resource->errors());
                foreach($errors as $error){
                    $errorMsg[]    =   $error;
                }
                
                $result['message']  =   implode("\n \r", $errorMsg);
            }
            
        } else {
            
        }
        $this->set(compact('result'));
    }

}
