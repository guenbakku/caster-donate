<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;

class ProfileController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thông tin cá nhân'));
    }

    public function edit()
    {   
        $user_id = $this->Auth->user('id');
        $ProfileLg = new Profile();
        
        if ($this->request->is('put')) {
            $new_user_info = $this->request->getData();
            $profile = $ProfileLg->edit($user_id, $new_user_info);
            
            if (!$profile->errors()) {   
                // Trigger event after edited profile
                $this->dispatchEvent(
                    Configure::read('Events.App_AfterEditProfile'), 
                    ['profile' => $profile]
                );
                $this->Flash->success(__('Thay đổi thông tin cá nhân thành công'));
            } else {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập'));
            }
        } else {
            $profile = $ProfileLg->get($user_id);
        }
        
        $this->set(compact('profile'));
    }
}
