<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Tag;

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
    }

    public function statistics()
    {
        $this->ContentHeader->title('Thống kê thu nhập');
    }

    public function schedule() 
    {
        $this->ContentHeader->title('Lịch LiveStream');
    }

    public function profile()
    {   
        $this->ContentHeader->title('Thông tin cá nhân');
        $user_id = $this->Auth->user('id');
        $Profile = new Profile();
        
        if ($this->request->is(['patch','post','put'])) {
            $new_user_info = $this->request->getData();
            $profile = $Profile->edit($user_id, $new_user_info);
            
            if (!$profile->errors()) {   
                // Trigger event after edited profile
                $this->dispatchEvent(
                    Configure::read('Events.Controller.Me.AfterEditProfile'), 
                    ['profile' => $profile]
                );
                $this->Flash->success(__('Thay đổi thông tin cá nhân thành công.'));
            } else {
                $this->Flash->error(__('Vui lòng kiểm tra thông tin đã nhập.'));
            }
        } else {
            $profile = $Profile->get($user_id);
        }
        
        $this->set(compact('profile'));
    }

    public function contract() 
    {
        $this->ContentHeader->title('Thông tin Lên Sóng');
    }

    public function tag()
    {
        $Tag = new Tag();
        $caster_tags = $this->request->data('caster_tags') ?: [];
        $user_id = $this->Auth->user('id');
        $Tag->save($user_id, $caster_tags);

        // Trigger event after edited tags
        $this->dispatchEvent(
            Configure::read('Events.Controller.Me.AfterEditTag')
        );

        $this->Flash->success(__('Thay đổi tag thành công.'));

        return $this->redirect($this->referer());
    }

}
