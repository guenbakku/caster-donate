<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
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
            'message'   => false,
            'newResourceInfo'  =>   [],
        ];

        if ($this->request->is('post')) {
            $new_resource = $this->request->getData();
            $resource = $Resources->addUserResource($user_id, $new_resource);

            if (!$resource->errors()) {   
                $result['message']  =   __('Upload file thành công.');
                $result['result']  =   true;
                $result['newResourceInfo']  =   $resource;
            } else {
                $result['message']  =   __('Upload file không thành công !');
            }
            
        } else {
            
        }
        $this->set(compact('result'));
    }

}
