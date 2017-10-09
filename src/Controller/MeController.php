<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Logic\Profile\Profile;
use App\Model\Logic\Profile\Tag;

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

    public function beforeRender(Event $event)
    {
        // Set default render setting
        if ($this->request->is('get')) {   
            $Profile = new Profile();
            $user_id = $this->Auth->user('id');
            $profile = $Profile->get($user_id);
            $this->set(compact('profile'));
        }
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
        
        if ($this->request->is(['patch','post','put'])) {
            $Profile = new Profile();
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

            // Cần có để hiện errors ra form
            $this->set(compact('profile'));
        }

        $this->render('/Me/index');
    }

    public function tag()
    {
        $Tag = new Tag();
        $caster_tags = $this->request->data('caster_tags') ?: [];
        $user_id = $this->Auth->user('id');
        $Tag->save($user_id, $caster_tags);
        $this->Flash->success(__('Thay đổi tag thành công.'));
         
        return $this->redirect($this->referer());
    }

    public function contract() 
    {
        $this->render('/Me/index');
    }

}
