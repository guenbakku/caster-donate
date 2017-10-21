<?php
namespace App\Controller\Me;

use Cake\Core\Configure;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Logic\User\Profile;
use App\Model\Logic\User\Tag;

class TagsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->ContentHeader->title(__('Thể loại live stream yêu thích'));
    }

    public function edit()
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
