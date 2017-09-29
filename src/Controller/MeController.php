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
        $profile = $this->Profile->get($user_id);
        $this->set(compact('profile'));
    }

    public function editProfile()
    {
        $user_id = $this->Auth->user('id');
        
        if($this->request->is(['POST','PUT']))
        {
            $this->Profile = new Profile();
            $new_user_info = $this->request->getData();

            $profile = $this->Profile->edit($user_id, $new_user_info);
            if(!$profile->errors())
            {
                $this->Flash->success(__('Thay đổi thông tin cá nhân thành công.'));
            }
            else
            {
                if ($profile->errors()){
                    $this->Flash->error(__('Vui lòng kiểm tra thông tin đã điền.'));                    
                }else
                {
                    $this->Flash->error(__('Không thể cập nhật thông tin.'));                    
                }
            }
        }
        $this->set('profile',$profile);
        $this->render('/Me/index');
    }
}
