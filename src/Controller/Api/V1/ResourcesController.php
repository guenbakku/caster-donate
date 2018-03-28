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

        if ($this->request->is('post')) {
            $new_resource = $this->request->getData();
            $resource = $Resources->addPrivateResource($user_id, $new_resource);

            if (!$resource->errors()) {   
                $result = $this->setResult([
                    'title' => __('Hoàn tất'),                    
                    'message' => __('File đã được tải lên.'),
                    'data' => array_merge($resource->toArray(), [
                        'url' => $resource->url,
                    ]),
                ]);
            } else {
                $result = $this->setResult([
                    'title' => __('Lỗi'),
                    'errors' => array_values(Hash::flatten($resource->errors())),
                ]);
            }
        } 

        $this->set(compact('result'));
    }
}
