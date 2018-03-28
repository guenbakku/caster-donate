<?php
namespace App\Controller\Api\V1;

use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Resources;

class ResourcesController extends ApiController
{
    public function upload()
    {
        $this->request->allowMethod(['post']);

        $user_id = $this->Auth->user('id');
        $Resources = new Resources();

        $new_resource = $this->request->getData();
        $resource = $Resources->addPrivateResource($user_id, $new_resource);

        $this->set(compact('resource'));
    }
}
