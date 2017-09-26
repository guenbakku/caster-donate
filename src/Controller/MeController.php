<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use App\Model\Logic\Profile\Profile;
use Cake\ORM\TableRegistry;
class MeController extends AppController
{
    public function index() 
    {
        $this->ContentHeader->title('Trang cá nhân');
        $user_id = $this->Auth->user('id');
        $this->Profile = new Profile();
        $profile = $this->Profile->view($user_id);
        $this->set(compact('profile'));
    }

    public function editprofile()
    {
        $user_id = $this->Auth->user('id');

        $this->UserInfos = TableRegistry::get('UserInfos');
        $query = $this->UserInfos->find()
                                ->where(['user_id' => $user_id])
                                ->all();
        if($this->request->is(['POST','PUT']))
        {
            $this->Profile = new Profile();
            if($query->count())
            {
                if($this->Profile->edit($user_id, $this->request->getData()))
                {
                    $this->Flash->success(__('Thay đổi thông tin cá nhân thành công.'));
                }
                else
                {
                    $this->Flash->error(__('Không thể tiến hành thay đổi thông tin.'));
                }
            }
            else
            {
                if($this->Profile->add($user_id, $this->request->getData()))
                {
                    $this->Flash->success(__('Cập nhật thông tin cá nhân thành công.'));
                }
                else
                {
                    $this->Flash->error(__('Không thể tiến hành cập nhật thông tin.'));
                }
            }
            
        }else{
            $this->Flash->error(__('Đã có lỗi xảy ra.'));
        }
        return $this->redirect(['controller' => 'me']);
    }
}
