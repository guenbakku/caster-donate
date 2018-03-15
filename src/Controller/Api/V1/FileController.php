<?php
namespace App\Controller\Api\V1;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Collection\Collection;
use Cake\Network\Exception\BadRequestException;
use App\Controller\Api\V1\ApiController;
use App\Model\Logic\User\Resources;

class FileController extends ApiController
{
    public function upload()
    {
        $user_id = $this->Auth->user('id');
        $Resources = new Resources();

        if ($this->request->is('post')) {
            $new_resource = $this->request->getData();
            $resource = $Resources->uploadNew($user_id, $new_resource);
            
            if (!$resource->errors()) {   
                $this->Flash->success(__('Upload ảnh thành công.'));
            } else {
                $this->Flash->error(__('Xảy ra lỗi trong quá trình upload ảnh.'));
            }
        } else {
            
        }
        
        // $this->set(compact('profile'));
        // debug($this->request->getData());
    }

}
