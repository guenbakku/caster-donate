<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Logic\Profile\Profile;

class MeController extends AppController
{
    public function index() 
    {
        return $this->redirect(['action' => 'statistics']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title('Trang cá nhân');
        $this->Profile = new Profile();
    }

    public function beforeRender(Event $event)
    {
        // Set default render setting
        $user_id = $this->Auth->user('id');
        $profile = $this->Profile->get($user_id);
        $this->set(compact('profile'));
    }

    public function statistics()
    {
        $this->render('/Me/index');
    }

    public function schedule() 
    {
        $this->render('/Me/index');
    }

    public function profile()
    {
        $user_id = $this->Auth->user('id');
        
        if($this->request->is(['patch','post','put']))
        {
            $new_user_info = $this->request->getData();
            $profile = $this->Profile->edit($user_id, $new_user_info);
            
            if(!$profile->errors())
            {   
                // Trigger event after edited profile
                $this->dispatchEvent(
                    Configure::read('Events.Controller.Me.AfterEditProfile'), 
                    ['profile' => $profile]
                );
                
                $this->Flash->success(__('Thay đổi thông tin cá nhân thành công.'));
            }
            else
            {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập.'));
            }
        }

        $this->render('/Me/index');
    }

    public function register() 
    {
        $this->render('/Me/index');
    }

}
